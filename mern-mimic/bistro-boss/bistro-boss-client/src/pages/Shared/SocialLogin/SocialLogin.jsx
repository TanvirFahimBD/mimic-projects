import { FcGoogle } from "react-icons/fc";
import useAuth from "../../../hooks/useAuth";
import useAxiosPublic from "../../../hooks/useAxiosPublic";
import { useNavigate } from "react-router-dom";

const SocialLogin = ({ text }) => {
    const { googleLogin } = useAuth();
    const axiosPublic = useAxiosPublic();
    const navigate = useNavigate();

    const handleGoogleLogin = () => {
        googleLogin()
            .then((result) => {
                const user = result.user;

                const userInfo = {
                    email: user?.email,
                    name: user?.displayName,
                    photo: user?.photoURL,
                    uid: user?.uid,
                    isAdmin: false
                }

                axiosPublic.post('/users', userInfo)
                    .then(res => {
                        console.log(res);
                        navigate('/');
                    })

            }).catch((error) => {
                const errorMessage = error.message;
                console.log(errorMessage);
            });
    }

    return (
        <div className="my-2 text-center">
            <div>
                <button className="btn" onClick={handleGoogleLogin}>
                    <FcGoogle className="text-2xl" />
                    {text}
                </button>

            </div>
        </div>
    );
};

export default SocialLogin;