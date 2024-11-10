<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    function ProductPage():View
    {
        return view('pages.dashboard.product-page');
    }

    public function ListProduct(Request $request):JsonResponse
    {
        try
        {
            $data = Product::where('user_id', '=', $request->header('id'))->get();
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
                    'message'=>'Product Data not found'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Product Data not found',
            ]);
        }

    }

    public function ProductCreate(Request $request):JsonResponse
    {
        try{
            $user_id = $request->header('id');

            $img = $request->file('img');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}.{$file_name}";
            $img_url = "uploads/${img_name}";
            $img->move(public_path('uploads'), $img_name);

            $name = $request->input('name');
            $price = $request->input('price');
            $unit = $request->input('unit');
            $category_id = $request->input('category_id');
            $data = Product::create([
                'name' => $name,
                'price' => $price,
                'unit' => $unit,
                'img_url' => $img_url,
                'user_id' => $user_id,
                'category_id' => $category_id,
            ]);

            if($data){
                return response()->json([
                    'status'=>'success',
                    'message'=>'Product Created Successfully!!!',
                    'response'=>$data
                ], 201);
            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Product create failed'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Product create failed',
            ]);
        }
    }

    public function ProductByID(Request $request):JsonResponse
    {
        try
        {
            $product_id = $request->input('id');
            $user_id = $request->header('id');
            $data = Product::where('user_id', '=' , $user_id)
                ->where('id', '=' , $product_id)
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

    public function ProductUpdate(Request $request):JsonResponse
    {
        try{
            $product_id = $request->input('id');
            $name = $request->input('name');
            $price = $request->input('price');
            $unit = $request->input('unit');
            $img_url = $request->input('img_url');
            $category_id = $request->input('category_id');
            $user_id = $request->header('id');
            $data = Product::where('user_id', '=' , $user_id)
                ->where('id', '=' , $product_id)
                ->update([
                    'name' => $name,
                    'price' => $price,
                    'unit' => $unit,
                    'img_url' => $img_url,
                    'category_id' => $category_id,
                ]);

            if($data){
                return response()->json([
                    'status'=>'success',
                    'message'=>'Product updated successfully',
                ], 200);
            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Product updated failed'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Product updated failed',
            ]);
        }

    }

    public function ProductDelete(Request $request):JsonResponse
    {
        try{
            $data = Product::where('id', '=', $request->input('id'))
                           ->where('user_id', '=', $request->header('id'))
                           ->delete();

            if($data){
                return response()->json([
                    'status'=>'success',
                    'message'=>'Product deleted successfully',
                    'data'=>$data
                ], 200);
            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Product delete failed'
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Product delete failed',
            ]);
        }

    }
}
