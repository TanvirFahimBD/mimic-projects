<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderController extends Controller
{
    public function GetAllProducts(){
        $data = DB::table('products')->get();
        return $data;
    }

    public function GetSingleProduct(){
        //$data = DB::table('products')->first();
        $data = DB::table('products')->find(2);
        return $data;
    }
    public function GetSingleProductPluck(){
        //$data = DB::table('brands')->pluck('brand_name');
        $data = DB::table('brands')->pluck('brand_img','brand_name' );
        return $data;
    }
    public function Aggregate(){
        $max = DB::table('products')->max('price');
        $min = DB::table('products')->min('price');
        $avg = DB::table('products')->avg('price');
        $count = DB::table('products')->count('price');
        $sum = DB::table('products')->sum('price');
        return [
            'max' => $max,
            'min' => $min,
            'avg' => $avg,
            'count' => $count,
            'sum' => $sum,
        ];
    }

    public function SelectColumn(){
//        $data = DB::table('products')->select('title', 'price')->get();
        $data = DB::table('products')->select('price')->distinct()->get();
        return $data;
    }

    public function InnerJoin(){
        $data = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
//                ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
//                ->rightJoin('brands', 'products.brand_id', '=', 'brands.id')
//                ->crossJoin('brands')
                ->select('products.*', 'categories.category_name', 'categories.category_img', 'brands.brand_name','brands.brand_img')
                ->get();
        return $data;
    }

    public function AdvanceJoin(){
        $data = DB::table('products')
                ->join('categories', function (JoinClause $join){
                    $join->on('products.category_id', '=', 'categories.id')
                         ->where('products.category_id', '=', '2');
                })

                ->join('brands', function (JoinClause $join){
                    $join->on('products.brand_id', '=', 'brands.id')
                    ->where('products.brand_id', '=', '2');
                })
                ->select('products.*', 'categories.category_name', 'categories.category_img', 'brands.brand_name','brands.brand_img')
                ->get();
        return $data;
    }

    public function WhereClause(){
//        $data = DB::table('products')->where('price', '>', 400)->get();
        $data = DB::table('products')->where('title', 'like', "%ph%")->get();
        return $data;
    }

    public function OrderByClause(){
//        $data = DB::table('products')->orderBy('id', 'desc')->get();
//        $data = DB::table('products')->orderBy('id', 'asc')->get();
        $data = DB::table('products')->inRandomOrder()->first();
        return $data;
    }

    public function GroupByHavingClause(){
        $data = DB::table('products')
            ->groupBy('price')
//            ->having('price', '>', 400)
            ->get();
        return $data;
    }

    public function SkipLimitClause(){
        $data = DB::table('products')
            ->skip(2)
            ->take(10)
            ->get();
        return $data;
    }

    public function InsertBrand(){
        $data = DB::table('brands')
            ->insert([
                'brand_name'=>'Demo name',
                'brand_img'=>'Demo img'
            ]);
        return $data;
    }

    public function UpdateRequestBodyUrl(Request $request){
        $id = $request->id;
        $brand_name = $request->input('brand_name');
        $brand_img = $request->input('brand_img');
        $data = DB::table('brands')
            ->where('id', $id)
            ->update([
                'brand_name'=>$brand_name,
                'brand_img'=>$brand_img
            ]);
        return $data;
    }

    public function UpdateOrInsertRequest(Request $request){
        $brand_name = $request->input('brand_name');
        $brand_img = $request->input('brand_img');
        $data = DB::table('brands')
            ->updateOrInsert(
                ['brand_name'=>$brand_name],
                ['brand_name'=>$brand_name, 'brand_img'=>$brand_img ]
            );
        return $data;
    }

    public function DeleteRequest(Request $request){
        $id = $request->id;
        $data = DB::table('brands')
            ->where('id', $id)
            ->delete();
        return $data;
    }

}
