import { FaTrash } from "react-icons/fa";
import useCart from "../../../hooks/useCart";
import Swal from "sweetalert2";
import useAxiosSecure from "../../../hooks/useAxiosSecure";
import { useEffect, useState } from "react";

const Cart = () => {
    const axiosSecure = useAxiosSecure();
    const [cart, isLoading, refetch] = useCart();
    const [carts, setCarts] = useState([]);
    const totalPrice = carts.reduce((sum, item) => sum + item.price, 0);

    useEffect(() => {
        if (!isLoading) {
            setCarts(cart);
        }
    }, [cart, isLoading]);


    const handleDelete = item => {
        Swal.fire({
            title: "Are you sure you want to delete it?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                axiosSecure.delete(`/carts/${item._id}`)
                    .then(res => {
                        if (res?.data?.deletedCount) {
                            // const currentCart = carts.filter(ct => ct._id !== item._id);
                            // setCarts(currentCart);
                            refetch();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Item deleted successfully",
                                icon: "success"
                            });
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });

            }
        });
    }

    if (isLoading && !cart.length) {
        return <p>Loading ...</p>
    }

    return (
        <div>
            <div className="flex justify-between m-5">
                <h2 className="text-4xl">Items: {carts.length}</h2>
                <h2 className="text-4xl">Total Price: {totalPrice.toFixed(1)}</h2>
                <button className="btn btn-error">Pay Now</button>
            </div>

            <div className="overflow-x-auto">
                <table className="table">
                    {/* head */}
                    <thead>
                        <tr>
                            <th>
                                SL No.
                            </th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {
                            carts.map((item, index) =>
                                <tr key={item._id}>
                                    <th>
                                        {index + 1}
                                    </th>
                                    <td>
                                        <div className="avatar">
                                            <div className="w-12 h-12 mask mask-squircle">
                                                <img
                                                    src={item.image}
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {item.name}
                                    </td>
                                    <td>
                                        ${item.price}
                                    </td>
                                    <th>
                                        <button className="text-2xl btn btn-danger btn-xs" onClick={() => handleDelete(item)}>
                                            <FaTrash className="text-red-500" />
                                        </button>
                                    </th>
                                </tr>
                            )
                        }

                    </tbody>
                </table>
            </div>
        </div>
    );
};

export default Cart;