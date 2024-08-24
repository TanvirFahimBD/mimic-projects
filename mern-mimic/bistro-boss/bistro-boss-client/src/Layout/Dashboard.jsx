import { NavLink, Outlet } from "react-router-dom";
import { FaBook, FaCartPlus, FaFirstOrder, FaHome, FaList, FaShoppingBag, FaSignOutAlt, FaStar, FaUser } from "react-icons/fa";
import { IoIosAddCircle, IoIosPersonAdd } from "react-icons/io";
import { MdEditNotifications, MdManageAccounts, MdManageHistory, MdNotificationAdd, MdRateReview } from "react-icons/md";
import { SiManageiq } from "react-icons/si";
import useCart from "../hooks/useCart";
import { useContext } from "react";
import { AuthContext } from "../providers/AuthProvider";


const Dashboard = () => {
    const [cart] = useCart();
    const { logOut } = useContext(AuthContext);
    // TODO: get the user is admin or not. depends on that change ui view. also check routes for admin only
    const isAdmin = false;

    const handleLogOut = () => {
        logOut().then(() => {
            console.log('signed out');
        }).catch((error) => {
            console.log(error);
        });
    }

    return (
        <div className="flex">
            <div className="w-64 min-h-screen bg-orange-500">
                <ul className="menu">
                    {
                        isAdmin
                            ?
                            <>
                                <li><NavLink to="/dashboard/adminHome"><FaHome /> Admin Home </NavLink></li>

                                <li><NavLink to="/dashboard/add-item"><IoIosAddCircle /> Add Item</NavLink></li>

                                <li><NavLink to="/dashboard/manage-items"><MdManageHistory /> Manage Items  </NavLink></li>

                                <li><NavLink to="/dashboard/manage-orders"><SiManageiq />  Manage Orders  </NavLink></li>

                                <li><NavLink to="/dashboard/add-admin"><IoIosPersonAdd /> Add Admin  </NavLink></li>

                                <li><NavLink to="/dashboard/manage-users"><MdManageAccounts /> Manage Users  </NavLink></li>

                                <li><NavLink to="/dashboard/manage-reviews"><MdRateReview /> Manage Reviews</NavLink></li>

                                <li><NavLink to="/dashboard/add-notification"><MdNotificationAdd /> Add Notification</NavLink></li>

                                <li><NavLink to="/dashboard/manage-notifications"><MdEditNotifications /> Manage Notifications</NavLink></li>

                                <li><NavLink to="/dashboard/profile"><FaUser /> My Profile</NavLink></li>
                            </>
                            :
                            <>
                                <li><NavLink to="/dashboard/userHome"><FaHome /> User Home </NavLink></li>

                                <li><NavLink to="/dashboard/cart"><FaCartPlus /> My Cart: {cart.length}</NavLink></li>

                                <li><NavLink to="/dashboard/my-orders"><FaFirstOrder /> My Orders</NavLink></li>

                                <li><NavLink to="/dashboard/add-review"><FaStar /> Add Review  </NavLink></li>

                                <li><NavLink to="/dashboard/my-reviews"><FaStar /> My Reviews  </NavLink></li>

                                <li><NavLink to="/dashboard/my-notifications"><FaBook /> My Notifications  </NavLink></li>

                                <li><NavLink to="/dashboard/profile"><FaUser /> My Profile</NavLink></li>
                            </>
                    }

                    <li className="divider"></li>
                    <li><NavLink to="/"><FaHome /> Home </NavLink></li>

                    <li><NavLink to="/menu"><FaList /> Menu</NavLink></li>

                    <li><NavLink to="/shop"><FaShoppingBag /> Shop</NavLink></li>

                    <li onClick={handleLogOut}><NavLink to="/login" ><FaSignOutAlt /> LogOut</NavLink></li>


                </ul>
            </div>
            <div className="flex-1">
                <Outlet />
            </div>
        </div>
    );
};

export default Dashboard;