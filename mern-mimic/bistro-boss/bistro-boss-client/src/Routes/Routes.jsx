import {
  createBrowserRouter,
} from "react-router-dom";
import Main from "../Layout/Main";
import Home from "../pages/Home/Home/Home";
import Menu from "../pages/Menu/Menu/Menu";
import Shop from "../pages/Shop/Shop/Shop";
import Login from "../pages/Login/Login";
import SignUp from "../pages/SignUp/SignUp";
import Dashboard from "../Layout/Dashboard";
import Cart from "../pages/Dashboard/Cart/Cart";
import Profile from "../pages/Dashboard/Profile/Profile";
import MyOrder from "../pages/Dashboard/MyOrder/MyOrder";
import AddReview from "../pages/Dashboard/AddReview/AddReview";
import PrivateRoute from "./PrivateRoute";
import UserHome from "../pages/Dashboard/UserHome/UserHome";
import MyReviews from "../pages/Dashboard/MyReviews/MyReviews";
import MyNotifications from "../pages/Dashboard/MyNotifications/MyNotifications";
import AdminHome from "../pages/Dashboard/AdminHome/AdminHome";
import AddItem from "../pages/Dashboard/AddItem/AddItem";
import ManageItems from "../pages/Dashboard/ManageItems/ManageItems";
import ManageOrders from "../pages/Dashboard/ManageOrders/ManageOrders";
import AddAdmin from "../pages/Dashboard/AddAdmin/AddAdmin";
import ManageUsers from "../pages/Dashboard/ManageUsers/ManageUsers";
import ManageReviews from "../pages/Dashboard/ManageReviews/ManageReviews";
import AddNotification from "../pages/Dashboard/AddNotification/AddNotification";
import ManageNotifications from "../pages/Dashboard/ManageNotifications/ManageNotifications";

export const router = createBrowserRouter([
  {
    path: "/",
    element: <Main></Main>,
    children: [
      {
        path: "/",
        element: <Home />,
      },
      {
        path: "menu",
        element: <Menu></Menu>,
      },
      {
        path: "shop",
        element: <Shop></Shop>,
      },
      {
        path: "shop/:category",
        element: <Shop></Shop>,
      },
      {
        path: "signup",
        element: <SignUp></SignUp>,
      },
      {
        path: "login",
        element: <Login></Login>,
      }
    ]
  },
  {
    path: "/dashboard",
    element: <PrivateRoute><Dashboard></Dashboard></PrivateRoute>,
    children: [
      {
        path: "userHome",
        element: <UserHome />,
      },
      {
        path: "cart",
        element: <Cart />,
      },
      {
        path: "my-orders",
        element: <MyOrder />,
      },
      {
        path: "add-review",
        element: <AddReview />,
      },
      {
        path: "my-reviews",
        element: <MyReviews />,
      },
      {
        path: "my-notifications",
        element: <MyNotifications />,
      },
      {
        path: "profile",
        element: <Profile />,
      },
      // admin routes 
      {
        path: "adminHome",
        element: <AdminHome />,
      },
      {
        path: "add-item",
        element: <AddItem />,
      },
      {
        path: "manage-items",
        element: <ManageItems />,
      },
      {
        path: "manage-orders",
        element: <ManageOrders />,
      },
      {
        path: "add-admin",
        element: <AddAdmin />,
      },
      {
        path: "manage-users",
        element: <PrivateRoute><ManageUsers /></PrivateRoute>,
      },
      {
        path: "manage-reviews",
        element: <ManageReviews />,
      },
      {
        path: "add-notification",
        element: <AddNotification />,
      },
      {
        path: "manage-notifications",
        element: <ManageNotifications />,
      }
    ]
  },
]);