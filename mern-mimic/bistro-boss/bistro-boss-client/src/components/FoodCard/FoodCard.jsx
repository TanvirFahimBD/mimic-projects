import Swal from "sweetalert2";
import useAuth from "../../hooks/useAuth";
import { useLocation, useNavigate } from "react-router-dom";
import useAxiosSecure from "../../hooks/useAxiosSecure";
import useCart from "../../hooks/useCart";


const FoodCard = ({ item }) => {
    const navigate = useNavigate();
    const axiosSecure = useAxiosSecure();
    const [, refetch] = useCart();
    const location = useLocation();
    const { user } = useAuth();
    const { _id, name, recipe, image, price } = item;

    const handleAddToCart = () => {
        if (user && user?.email) {
            // add to db  
            const cartItem = {
                menuId: _id,
                email: user?.email,
                name,
                recipe,
                image,
                price
            }

            axiosSecure.post('/carts', cartItem)
                .then(function (response) {
                    if (response?.data?.insertedId) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: `${name} added to cart successfully`,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        refetch();
                    }
                }).catch(function (error) {
                    console.log(error);
                });


        } else {
            Swal.fire("Login first to add to cart!");
            navigate('/login', { state: { from: location } });
        }
    }

    return (
        <div className="relative my-3 shadow-xl card bg-base-100 w-96">
            <figure className="h-60">
                <img
                    src={image}
                    alt="dishe"
                />
            </figure>

            <p className="absolute right-0 p-2 m-4 text-gray-100 rounded-md bg-stone-900">${price}</p>

            <div className="card-body">
                <h2 className="card-title">{name}</h2>
                <p className="justify-start text-left">{recipe}</p>
                {/* <p>{price}</p> */}
                <div className="justify-center card-actions">
                    <button className="btn btn-primary" onClick={() => handleAddToCart(item)}>Add to cart</button>
                </div>
            </div>
        </div>
    );
};

export default FoodCard;