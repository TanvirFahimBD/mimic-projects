
const SingleItem = ({ item }) => {
    const { name, recipe, image, price } = item;
    return (
        <div className="grid grid-cols-3">
            <div>
                <img style={{ borderRadius: '0 200px 200px 200px' }} className="border shadow-md " src={image} alt="" width={200} />
            </div>
            <div className="mx-3">
                <h2 className="text-2xl">{name} --------</h2>
                <h4 className="text-1xl">{recipe}</h4>
            </div>
            <div>
                <p className="mt-2 text-orange-300 text-1xl">${price}</p>
            </div>
        </div>
    );
};

export default SingleItem;