<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Mockery\Exception;

class UserController extends Controller
{
    public function UserRegistration(Request $request)
    {
        try {
            $result = User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password')
            ]);

            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User created successfully',
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User creation failed',
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User creation failed',
            ], 401);
        }
    }

    public function UserLogin(Request $request)
    {
        try {
            $result = User::where('email', '=', $request->input('email'))
                ->where('password', '=', $request->input('password'))
                ->select('id')->first();

            if ($result !== null) {
                $token = JWTToken::CreateToken($request->input('email'), $result->id);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged in successfully'
                ], 200)->cookie('token', $token, 60 * 60 * 24, '/');
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Login failed'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login failed',
            ]);
        }
    }

    public function SendOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);

        try {
            $count = User::where('email', '=', $email)
                ->count();

            if ($count == 1) {
                //otp email send
                Mail::to($email)->send(new OTPMail($otp));
                //table update otp
                User::where('email', '=', $email)->update(['otp' => $otp]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'An OTP Send to your email successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'OTP Send failed',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP Send failed',
            ]);
        }
    }

    public function VerifyOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');

        try {
            $count = User::where('email', '=', $email)
                ->where('otp', '=', $otp)
                ->count();

            if ($count == 1) {
                //otp update
                User::where('email', '=', $email)->update(['otp' => 0]);
                //password reset token issue
                $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP Verified successfully',
                ], 200)->cookie('token', $token, 60 * 60 * 24, '/');
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'OTP Verification failed',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP Verification failed',
            ]);
        }
    }

    public function ResetPassword(Request $request)
    {
        try {
            $password = $request->input('password');
            $email = $request->header('email');

            $count = User::where('email', '=', $email)
                ->count();

            if ($count == 1) {
                User::where('email', '=', $email)->update(['password' => $password]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password Reset successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password Reset failed',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password Reset failed',
            ]);
        }
    }

    public function UserLogout(Request $request)
    {
        return redirect('/userLogin')->cookie('token', '', -1);
    }

    public function UserProfile(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        if ($user->id) {
            return response()->json([
                "status" => "success",
                "message" => "Request successful",
                "data" => $user
            ], 200);
        }
    }

    public function UserUpdate(Request $request)
    {
        try {
            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $mobile = $request->input('mobile');
            $password = $request->input('password');
            $email = $request->header('email');

            $count = User::where('email', '=', $email)
                ->update([
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'mobile' => $mobile,
                    'password' => $password,
                ]);

            if ($count == 1) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile Updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Profile Update failed',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Profile Update failed',
            ]);
        }
    }

    function LoginPage(): View
    {
        return view('pages.auth.login-page');
    }

    function RegistrationPage(): View
    {
        return view('pages.auth.registration-page');
    }
    function SendOtpPage(): View
    {
        return view('pages.auth.send-otp-page');
    }
    function VerifyOTPPage(): View
    {
        return view('pages.auth.verify-otp-page');
    }

    function ResetPasswordPage(): View
    {
        return view('pages.auth.reset-pass-page');
    }

    function ProfilePage(): View
    {
        return view('pages.dashboard.profile-page');
    }
}
