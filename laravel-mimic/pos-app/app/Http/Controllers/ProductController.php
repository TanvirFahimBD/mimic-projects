<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    function ProductPage(): View
    {
        return view('pages.dashboard.product-page');
    }

    public function ListProduct(Request $request): JsonResponse
    {
        try {
            $user_id = $request->header('id');
            $data = Product::where('user_id', '=', $user_id)->get();

            if (count($data)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request successful',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product Data not found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product Data not found',
            ], 404);
        }
    }

    public function ProductCreate(Request $request): JsonResponse
    {
        try {
            $user_id = $request->header('id');

            $img = $request->file('img');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url = "uploads/" . $img_name . "";
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

            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product Created Successfully!!!',
                    'response' => $data
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product create failed'
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product create failed',
            ], 400);
        }
    }

    public function ProductDelete(Request $request): JsonResponse
    {
        try {
            $user_id = $request->header('id');
            $product_id = $request->input('id');
            $filePath = $request->input('file_path');
            File::delete($filePath);
            $data = Product::where('id', '=', $product_id)
                ->where('user_id', '=', $user_id)
                ->delete();


            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product deleted successfully',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product delete failed'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product delete failed',
            ], 404);
        }
    }

    public function ProductByID(Request $request): JsonResponse
    {
        try {
            $product_id = $request->input('id');
            $user_id = $request->header('id');
            $data = Product::where('id', '=', $product_id)
                ->where('user_id', '=', $user_id)
                ->first();
            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product Found',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found',
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], 404);
        }
    }

    public function ProductUpdate(Request $request): JsonResponse
    {
        try {
            //product new image file given. then upload the new one & delete the previous one and use current image url
            $img_url = '';
            $user_id = $request->header('id');

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $t = time();
                $file_name = $img->getClientOriginalName();
                $img_name = "{$user_id}-{$t}-{$file_name}";
                $img_url = "uploads/" . $img_name . "";
                $img->move(public_path('uploads'), $img_name);

                $filePath = $request->input('img_url');
                File::delete($filePath);
            } else {
                $img_url = $request->input('img_url');
            }

            $product_id = $request->input('id');
            $name = $request->input('name');
            $price = $request->input('price');
            $unit = $request->input('unit');
            $category_id = $request->input('category_id');
            $data = Product::where('user_id', '=', $user_id)
                ->where('id', '=', $product_id)
                ->update([
                    'name' => $name,
                    'price' => $price,
                    'unit' => $unit,
                    'img_url' => $img_url,
                    'category_id' => $category_id,
                ]);

            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product update failed'
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product update failed',
            ], 400);
        }
    }
}
