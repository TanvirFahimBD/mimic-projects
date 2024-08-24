import { FaTrash } from "react-icons/fa";
import { RiAdminFill } from "react-icons/ri";
import useAxiosSecure from "../../../hooks/useAxiosSecure";
import { useQuery } from "@tanstack/react-query";
import useAuth from "../../../hooks/useAuth";
import { MdAdminPanelSettings } from "react-icons/md";
import Swal from "sweetalert2";

const ManageUsers = () => {
    const { user, loading } = useAuth();
    const axiosSecure = useAxiosSecure();
    const { refetch, isPending, data: users = [] } = useQuery({
        queryKey: ['users'],
        queryFn: async () => {
            const res = await axiosSecure.get(`/users?email=${user?.email}`);
            return res.data;
        }

    })

    const handleDelete = (u) => {
        Swal.fire({
            title: "Are you sure you want to delete it?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                if (u.email !== user?.email) {
                    axiosSecure.delete(`/users/${u.uid}`)
                        .then(res => {
                            if (res?.data?.deletedCount) {
                                refetch();
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "User deleted successfully",
                                    icon: "success"
                                });
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Wrong action",
                        text: "Can not delete your own profile!",
                    });
                }

            }
        });
    }

    const handleAdmin = (u) => {
        const adminTitle = u.isAdmin ? "remove" : "make";

        Swal.fire({
            title: `Are you sure you want to ${adminTitle} admin?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: `${adminTitle} Admin`
        }).then((result) => {
            if (result.isConfirmed) {
                if (u.email !== user?.email) {
                    axiosSecure.patch("/users/admin", u)
                        .then(res => {
                            if (res?.data?.modifiedCount) {
                                refetch();
                                Swal.fire({
                                    title: `Admin ${adminTitle}!`,
                                    text: `User ${adminTitle} admin successfully`,
                                    icon: "success"
                                });
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Wrong action",
                        text: "Can not make your own admin!",
                    });
                }

            }
        });
    }


    if (loading || isPending) {
        return <p>Loading ...</p>;
    }

    return (
        <div>
            <div className="flex justify-between m-5">
                <h2 className="text-4xl">All Users </h2>
                <h2 className="text-4xl">Total Users: {users.length}</h2>
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
                            <th>Email</th>
                            <th>Admin Manage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        {
                            users.map((ur, index) =>
                                <tr key={ur._id}>
                                    <th>
                                        {index + 1}
                                    </th>
                                    <td>
                                        <div className="avatar">
                                            <div className="w-12 h-12 mask mask-squircle">
                                                <img
                                                    src={ur.photo}
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        {ur.name}
                                    </td>
                                    <td>
                                        {ur.email}
                                    </td>
                                    <td>
                                        {/* admin manage */}
                                        {
                                            !ur.isAdmin
                                                ?
                                                <button title="Make Admin" className="text-2xl btn btn-danger btn-xs" onClick={() => handleAdmin(ur)}>
                                                    <MdAdminPanelSettings className="text-green-500" />
                                                </button>
                                                : <button title="Remove Admin" className="text-2xl btn btn-danger btn-xs" onClick={() => handleAdmin(ur)}>
                                                    <RiAdminFill className="text-green-500" />
                                                </button>

                                        }
                                    </td>
                                    <th>


                                        {/* delete  */}
                                        <button className="text-2xl btn btn-danger btn-xs" onClick={() => handleDelete(ur)}>
                                            <FaTrash className="text-red-500" />
                                        </button>
                                    </th>
                                </tr>)
                        }

                    </tbody>
                </table>
            </div>
        </div>
    );
};

export default ManageUsers;