import { useContext, useState } from 'react';
import { AuthContext } from '../../providers/AuthProvider';
import { Link, useNavigate } from 'react-router-dom';
import { useForm } from "react-hook-form"
import PageTitle from '../../components/PageTitle/PageTitle';
import Swal from 'sweetalert2';
import useAxiosPublic from '../../hooks/useAxiosPublic';
import SocialLogin from '../Shared/SocialLogin/SocialLogin';
const SignUp = () => {
    const [error, setError] = useState('');
    const axiosPublic = useAxiosPublic();
    const { createUser, updateUserProfile } = useContext(AuthContext);
    const navigate = useNavigate();
    const from = '/login';

    const {
        register,
        handleSubmit,
        reset,
        formState: { errors },
    } = useForm();

    const onSubmit = (data) => {
        const email = data.email;
        const password = data.password;
        const name = data.name;
        const photo = data.photo;

        createUser(email, password)
            .then((userCredential) => {
                const user = userCredential.user;
                updateUserProfile(name, photo).then(() => {
                    const userInfo = {
                        name,
                        email,
                        photo,
                        uid: user?.uid,
                        isAdmin: false
                    }

                    axiosPublic.post('/users', userInfo)
                        .then(res => {
                            if (res?.data?.insertedId) {
                                reset();
                                Swal.fire({
                                    position: "top-start",
                                    icon: "success",
                                    title: "Profile Created Successfully",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                        })
                        .catch(error => {
                            console.log(error.messge);
                        })

                    setTimeout(() => {
                        if (user?.email) {
                            navigate(from);
                        }
                    }, 2000);

                }).catch((error) => {
                    const errorMessage = error.message;
                    console.log(errorMessage);
                });
            })
            .catch((error) => {
                const errorMessage = error.message.split(' ');
                const errorMsg = errorMessage[errorMessage.length - 1].split("-").join(' ');
                setError(errorMsg);
            });
    }

    return (
        <>
            <PageTitle title="SignUp | Bistro Boss" />
            <div className="min-h-screen hero bg-base-200">
                <div className="flex-col hero-content lg:flex-row-reverse">

                    <div className="w-full max-w-sm shadow-2xl card bg-base-100 shrink-0">
                        <form onSubmit={handleSubmit(onSubmit)} className="card-body">
                            {/* name  */}
                            <div className="form-control">
                                <label className="label">
                                    <span className="label-text">Name * </span>
                                </label>
                                <input type="text"  {...register("name", { required: true })} name="name" placeholder="Name" className="input input-bordered" />
                                {errors.name && <span className='text-red-500'>Name is required</span>}
                            </div>

                            {/* Email  */}
                            <div className="form-control">
                                <label className="label">
                                    <span className="label-text">Email * </span>
                                </label>
                                <input type="email" {...register("email", { required: true })} name="email" placeholder="email" className="input input-bordered" />
                                {errors.email && <span className='text-red-500'>Email is required</span>}
                                {error && <span className='text-red-500'>{error}</span>}
                            </div>

                            {/* Password  */}
                            <div className="form-control">
                                <label className="label">
                                    <span className="label-text">Password * </span>
                                </label>
                                <input type="password"   {...register("password", { required: true, pattern: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/i })} name="password" placeholder="password" className="input input-bordered" />
                                {errors.password?.type === 'required' && <span className='text-red-500'> Password is required </span>}
                                {errors.password?.type === 'pattern' && <span className='text-red-500'> Password At least one upper case, at least one lower case English letter, at least one digit, at least one special character and minimum eight in length </span>}
                            </div>


                            {/* photo  */}
                            {/* TODO: upload image to imgbb & get the url 69-4 Video L1  */}
                            <div className="form-control">
                                <label className="label">
                                    <span className="label-text">Photo URL </span>
                                </label>
                                <input type="text"  {...register("photo")} name="photo" placeholder="Photo URL" className="input input-bordered" />
                                {errors.photo && <span className='text-red-500'> {errors.photo}</span>}
                            </div>

                            <div className="mt-6 form-control">
                                <input type="submit" className="btn btn-primary" value="SignUp" />
                            </div>

                        </form>
                        <div className="-mt-3 divider"></div>
                        <SocialLogin text="SignUp with Google" />
                        <Link to="/login" className='mb-2 text-center'>
                            <p className='text-blue-600'>Already have an account? Login now!</p>
                        </Link>
                    </div>

                    <div className="text-center lg:text-left">
                        <h1 className="text-5xl font-bold">SignUp now!</h1>
                        <p className="py-6">
                            Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                            quasi. In deleniti eaque aut repudiandae et a id nisi.
                        </p>


                    </div>
                </div>
            </div>
        </>
    );
};

export default SignUp;