const express = require('express');
const app = express();
const jwt = require('jsonwebtoken');
const cors = require('cors');
const port = process.env.PORT || 5000;
require('dotenv').config();
const { MongoClient, ServerApiVersion, ObjectId } = require('mongodb');
const admin = require('firebase-admin');
const path = require('path');
// Load the service account key JSON file
const serviceAccountPath = process.env.SERVICE_ACCOUNT_KEY_PATH;
const serviceAccount = require(path.resolve(__dirname, serviceAccountPath));
// Initialize Firebase Admin SDK
admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});
const uri = `mongodb+srv://${process.env.DB_USER}:${process.env.DB_PASS}@cluster0.hqjnl.mongodb.net/?appName=Cluster0`;

const client = new MongoClient(uri, {
  serverApi: {
    version: ServerApiVersion.v1,
    strict: true,
    deprecationErrors: true,
  }
});




//middleware
app.use(cors());
app.use(express.json());

const verifyToken = (req, res, next) => {
  if (!req.headers.authorization) {
    return res.status(401).send({ message: 'forbidden access' });
  }

  const token = req.headers.authorization.split(' ')[1];  
  jwt.verify(token, process.env.ACCESS_TOKEN_SECRET, (err, decoded) => {
    if (err) {
      return res.status(401).send({ message: 'forbidden access' });
    } else {      
      req.decoded = decoded;
      next();
    }
  })
}




async function run() {
  try {
    await client.connect();
    await client.db("admin").command({ ping: 1 });
    console.log("Pinged your deployment. You successfully connected to MongoDB!");
      
    const menuCollection = client.db("bistroDb").collection("menu");
    const reviewsCollection = client.db("bistroDb").collection("reviews");
    const cartCollection = client.db("bistroDb").collection("carts");
    const userCollection = client.db("bistroDb").collection("users");

    //==================================================================
    //jwt related api
    //==================================================================
    app.post('/jwt', async (req, res) => {
      const user = req.body;
      const secretKey = process.env.ACCESS_TOKEN_SECRET;
      const token = jwt.sign(user, secretKey, { expiresIn: "1h" })
      res.send({token});
    })

    app.get('/menu', async (req, res) => {
      const result = await menuCollection.find({}).toArray();
      res.send(result);
    })
    
    app.get('/reviews', async (req, res) => {
      const result = await reviewsCollection.find({}).toArray();
      res.send(result);
    })
    
    //===================================================================
    //cart collection
    //===================================================================

    //post cart
    app.post('/carts', async (req, res) => {
      const cartItem = req.body;
      console.log(cartItem);
      const result = await cartCollection.insertOne(cartItem);
      res.send(result);
    })
    
    //get cart
    app.get('/carts', verifyToken, async (req, res) => {
      if (req.decoded.email == req.query.email) {
        const email = req.query.email;
        const query = { email };
        const result = await cartCollection.find(query).toArray();
        res.send(result);
      }
      
    })
    
    //delete cart
    app.delete('/carts/:id', verifyToken, async (req, res) => {
      const id = req.params.id;
      const _id = new ObjectId(id);
      const query = { _id };
      const result = await cartCollection.deleteOne(query);
      res.send(result);
    })

    //===================================================================
    //user collection
    //===================================================================

    //post user
    app.post('/users', async (req, res) => {
      const user = req.body;
      const query = { email: user.email };
      const existingUser = await userCollection.findOne(query);
      if (existingUser) {
        return res.send({message: 'user already exists', insertedId: null});
      }
      const result = await userCollection.insertOne(user);
      res.send(result);
    })

    //get user
    app.get('/users', verifyToken, async (req, res) => {
      const userEmail = req.query.email;
      if (req.decoded.email == userEmail) {
        const query = { email: userEmail };
        const existingUser = await userCollection.findOne(query);
        if (!existingUser) {
          return res.send({message: 'user not eligible to get all users data', insertedId: null});
        }
        const result = await userCollection.find({}).toArray();
        res.send(result);
      }       
    })

    //delete user
    app.delete('/users/:uid', verifyToken, async (req, res) => {
      const uid = req.params.uid;
      const query = { uid: uid };
      const existingUser = await userCollection.findOne(query);
      if (!existingUser) {
        return res.send({message: 'user not exists', deletedCount: null});
      }
      await admin.auth().deleteUser(uid);
      const result = await userCollection.deleteOne(query);
      res.send(result);
    })

    app.patch('/users/admin', verifyToken, async (req, res) => {
        const user = req.body;
        const id = req.body._id;
        const _id = new ObjectId(id);
        const query = { _id };
        const existingUser = await userCollection.findOne(query);
        if (!existingUser) {
          return res.send({message: 'user not exists'});
        }

        const updateDoc = {
          $set: {
            isAdmin: !user.isAdmin
          }
        }
        const options = { upsert: false };
        
        const result = await userCollection.updateOne(query, updateDoc,options);
        res.send(result);
    })


  } finally {
    // await client.close();
  }
}
run().catch(console.dir);


app.get('/', (req, res) => {
  res.send('BB is live');
})

app.listen(port, () => {
    console.log(`BB listen on port ${port}`);
})