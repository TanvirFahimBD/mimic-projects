<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Category;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    function CategoryPage():View
    {
        return view('pages.dashboard.category-page');
    }
    public function ListCategory(Request $request):JsonResponse
    {
        try
        {
            $data = Category::where('user_id', '=', $request->header('id'))->get();
            if(count($data)){
                return response()->json([
                    'status'=>'success',
                    'message'=>'Request successful',
                    'data'=>$data
                ], 200);
            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Category Data not found'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Category Data not found',
            ]);
        }

    }

    public function CategoryCreate(Request $request):JsonResponse{
        try{
            $name = $request->input('name');
            $user_id = $request->header('id');
            $data = Category::create([
                'name' => $name,
                'user_id' => $user_id,
            ]);
            if($data){
                return response()->json([
                    'status'=>'success',
                    'message'=>'Category Created Successfully!!!',
                    'response'=>$data
                ], 201);
            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Category create failed'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Category create failed',
            ]);
        }

    }
    public function CategoryByID(Request $request):JsonResponse
    {
        try
        {
            $category_id = $request->input('id');
            $user_id = $request->header('id');
            $data = Category::where('user_id', '=' , $user_id)
                              ->where('id', '=' , $category_id)
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
    public function CategoryUpdate(Request $request):JsonResponse{
        try{
            $category_id = $request->input('id');
            $name = $request->input('name');
            $user_id = $request->header('id');
            $data = Category::where('user_id', '=' , $user_id)
                ->where('id', '=' , $category_id)
                ->update([
                    'name' => $name
                ]);
            if($data){
                return response()->json([
                    'status'=>'success',
                    'message'=>'Category updated successfully',
                ], 200);
            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Category updated failed'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Category updated failed',
            ]);
        }

    }
    public function CategoryDelete(Request $request):JsonResponse{
        try{
            $data = Category::where('id', '=', $request->input('id'))
                    ->where('user_id', '=', $request->header('id'))
                    ->delete();
            if($data){
                return response()->json([
                    'status'=>'success',
                    'message'=>'Category deleted successfully',
                    'data'=>$data
                ], 200);
            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Category delete failed'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Category delete failed',
            ]);
        }

    }

}
