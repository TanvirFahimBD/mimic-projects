import { useContext } from "react";
import { Link } from "react-router-dom";
import { AuthContext } from "../../../providers/AuthProvider";
import { FaCartPlus } from "react-icons/fa";
import useCart from "../../../hooks/useCart";
const Navbar = () => {
    const { user, logOut } = useContext(AuthContext);
    const [cart] = useCart();

    const handleLogOut = () => {
        logOut().then(() => {
            console.log('signed out');
        }).catch((error) => {
            console.log(error);
        });
    }

    const navOptions =
        <>
            <li>
                <Link to="/">Home</Link>
            </li>
            <li>
                <Link to="/menu">Our Menu</Link>
            </li>
            <li>
                <Link to="/shop">Our Shop</Link>
            </li>
            <li>
                <Link to="/dashboard/cart">
                    <FaCartPlus />
                    <div className="badge badge-error">  +{cart.length}</div>
                </Link>
            </li>

            {
                !user?.email
                &&
                <li>
                    <Link to="/login">Login</Link>
                </li>
            }
            {
                user?.displayName
                    ?
                    <li>
                        <Link to="/dashboard/profile">{user?.displayName}</Link>
                    </li>
                    :
                    <li>
                        <Link to="/dashboard/profile">{user?.email.split('@')[0]}</Link>
                    </li>
            }
        </>;

    return (
        <div className="max-w-screen-xl bg-opacity-60 navbar bg-base-100">
            <div className="navbar-start">
                <div className="dropdown">
                    <div tabIndex={0} role="button" className="btn btn-ghost lg:hidden">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul
                        tabIndex={0}
                        className="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        {navOptions}
                    </ul>
                </div>
                <Link to="/" className="text-xl btn btn-ghost">Bistro Boss</Link>
            </div>
            <div className="hidden navbar-center lg:flex">
                <ul className="px-1 menu menu-horizontal">
                    {navOptions}
                </ul>
            </div>
            {user?.email
                &&
                <div className="navbar-end">
                    <Link to='/login'>
                        <button className="btn btn-error" onClick={handleLogOut} >Logout</button>
                    </Link>
                </div>
            }
            {!user?.email
                &&
                <div className="navbar-end">
                    <Link to='/signup'>
                        <button className="btn btn-primary" >SignUp</button>
                    </Link>
                </div>
            }
        </div>
    );
};

export default Navbar;