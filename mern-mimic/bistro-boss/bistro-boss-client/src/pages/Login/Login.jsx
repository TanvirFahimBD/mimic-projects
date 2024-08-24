import { useContext, useEffect, useState } from 'react';
import { loadCaptchaEnginge, LoadCanvasTemplateNoReload, validateCaptcha } from 'react-simple-captcha';
import { AuthContext } from '../../providers/AuthProvider';
import { Link, useLocation, useNavigate } from 'react-router-dom';
import PageTitle from '../../components/PageTitle/PageTitle';
import Swal from 'sweetalert2'
import SocialLogin from '../Shared/SocialLogin/SocialLogin';

const Login = () => {
    const location = useLocation();
    const { signInUser } = useContext(AuthContext);
    const navigate = useNavigate();
    const [disabled, setDisabled] = useState(true);
    const [captchaDisabled, setCaptchaDisabled] = useState(false);
    const [message, setMessage] = useState("");
    const from = location?.state?.from || '/';

    const handleLogin = (e) => {
        e.preventDefault();
        const email = e.target.email.value;
        const password = e.target.password.value;

        signInUser(email, password)
            .then((userCredential) => {
                const user = userCredential.user;
                console.log(user?.email);
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Login Successfully",
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout(() => {
                    if (user?.email && from) {
                        navigate(from, { replace: true });
                    }
                }, 2000);
            })
            .catch((error) => {
                const errorMessage = error.message;
                console.log(errorMessage);
            });
    }

    const handleCaptcha = (e) => {
        e.preventDefault();
        let user_captcha_value = document.getElementById('user_captcha_input').value;

        if (validateCaptcha(user_captcha_value) == true) {
            setMessage('');
            setDisabled(false);
            setCaptchaDisabled(true);
        }

        else {
            setMessage('Captcha does not match');
        }
    }

    useEffect(() => {
        loadCaptchaEnginge(6);
    }, [])

    return (
        <>
            <PageTitle title="Login | Bistro Boss" />
            <div className="min-h-screen hero bg-base-200">
                <div className="flex-col hero-content lg:flex-row-reverse">
                    <div className="text-center lg:text-left">
                        <h1 className="text-5xl font-bold">Login now!</h1>
                        <p className="py-6">
                            Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                            quasi. In deleniti eaque aut repudiandae et a id nisi.
                        </p>
                    </div>
                    <div className="w-full max-w-sm shadow-2xl card bg-base-100 shrink-0">
                        <SocialLogin text="Login with Google" />
                        <div className="-mb-3 divider"></div>
                        <form onSubmit={handleLogin} className="card-body">

                            {/* email  */}
                            <div className="form-control">
                                <label className="label">
                                    <span className="label-text">Email * </span>
                                </label>
                                <input type="email" name="email" placeholder="email" className="input input-bordered" required />
                            </div>

                            {/* Password  */}
                            <div className="form-control">
                                <label className="label">
                                    <span className="label-text">Password * </span>
                                </label>
                                <input type="password" name="password" placeholder="password" className="input input-bordered" required />
                                <label className="label">
                                    <a href="#" className="label-text-alt link link-hover">Forgot password?</a>
                                </label>
                            </div>

                            {/* captcha  */}
                            <div className="form-control">
                                <LoadCanvasTemplateNoReload />
                                <input type="text" id="user_captcha_input" name="captcha" placeholder="Type current captcha" className="input input-bordered" required />
                                <input type="button" className="mt-2 btn btn-xs" value="Match Capcha" onClick={handleCaptcha} disabled={captchaDisabled} />
                                {
                                    message && <span className='text-red-500'> {message}</span>
                                }
                            </div>

                            {/* submit  */}
                            <div className="mt-6 form-control">
                                <input type="submit" className="btn btn-primary" value="Login" disabled={disabled} />
                            </div>
                            <Link to="/signup" className='my-2'>
                                <p className='text-blue-600'>Don&apos;t have an account? Create an account now!</p>
                            </Link>
                        </form>
                    </div>
                </div>
            </div>
        </>

    );
};

export default Login;