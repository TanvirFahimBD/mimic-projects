<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    function CustomerPage():View
    {
        return view('pages.dashboard.customer-page');
    }

    public function ListCustomer(Request $request):JsonResponse
    {
        try
        {
            $data = Customer::where('user_id', '=', $request->header('id'))
                            ->orderBy('id', 'desc')
                            ->get();

            if(count($data))
            {
                return response()->json([
                    'status'=>'success',
                    'message'=>'Request successful',
                    'data'=>$data
                ], 200);
            }
            else
            {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Customer Data not found'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Customer Data not found',
            ]);
        }

    }

    public function CustomerCreate(Request $request):JsonResponse
    {
        try
        {
            $name = $request->input('name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $user_id = $request->header('id');
            $data = Customer::create([
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'user_id' => $user_id,
            ]);

            if($data)
            {
                return response()->json([
                    'status'=>'success',
                    'message'=>'Customer Created Successfully',
                    'response'=>$data
                ], 201);
            }
            else
            {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Customer create failed!!!'
                ]);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Customer create failed!!!',
            ]);
        }

    }

    public function CustomerByID(Request $request):JsonResponse
    {
        try
        {
            $customer_id = $request->input('id');
            $user_id = $request->header('id');
            $data = Customer::where('user_id', '=' , $user_id)
                ->where('id', '=' , $customer_id)
                ->first();

            if($data)
            {
                return response()->json([
                    'status'=>'success',
                    'data' => $data
                ], 200);
            }
            else{
                return response()->json([
                    'status'=>'error'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error'
            ]);
        }

    }

    public function CustomerUpdate(Request $request):JsonResponse
    {
        try
        {
            $customer_id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $user_id = $request->header('id');
            $data = Customer::where('user_id', '=' , $user_id)
                ->where('id', '=' , $customer_id)
                ->update([
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile
                ]);

            if($data)
            {
                return response()->json([
                    'status'=>'success',
                    'message'=>'Customer updated successfully',
                    'data' => $data
                ], 200);
            }
            else
            {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Customer updated failed'
                ]);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Customer updated failed',
            ]);
        }

    }

    public function CustomerDelete(Request $request):JsonResponse
    {
        try
        {
            $data = Customer::where('id', '=', $request->input('id'))
                            ->where('user_id', '=', $request->header('id'))
                            ->delete();

            if($data)
            {
                return response()->json([
                    'status'=>'success',
                    'message'=>'Customer deleted successfully',
                    'data'=>$data
                ], 200);
            }
            else
            {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Customer delete failed!!!'
                ]);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Customer delete failed!!!',
            ]);
        }
    }
}
