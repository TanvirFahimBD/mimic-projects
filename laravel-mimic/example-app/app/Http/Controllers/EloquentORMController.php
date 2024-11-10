<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentORMController extends Controller
{
    public function CreateBrandEORM(Request $request){
        $data = Brand::create($request->input());
        return $data;
    }

    public function UpdateBrandEORM(Request $request){
        $data = Brand::where('id', $request->id)
                    ->update($request->input());
        return $data;
    }

    public function UpdateOrCreateRequestEORM(Request $request){
        $brand_name = $request->input('brand_name');
        $brand_img = $request->input('brand_img');
        $data = Brand::updateOrCreate(
                ['brand_name'=>$brand_name],
                ['brand_name'=>$brand_name, 'brand_img'=>$brand_img ]
            );
        return $data;
    }

    public function DeleteRequestEORM(Request $request){
        $id = $request->id;
        $data = Brand::where('id', $id)
            ->delete();
        return $data;
    }

    public function GetAllBrandsEORM(){
        $data = Brand::all();
        return $data;
    }

    public function GetSingleBrandEORM(){
//        $data = Brand::first();
        $data = Brand::find(1);
        return $data;
    }

    public function GetListOfColumnEORM(){
        $data = Brand::pluck('brand_img', 'brand_name');
        return $data;
    }

    public function AggregateEORM(){
        $max =  Brand::max('id');
        $min =  Brand::min('id');
        $avg =  Brand::avg('id');
        $count =  Brand::count('id');
        $sum =  Brand::sum('id');
        return [
            'max' => $max,
            'min' => $min,
            'avg' => $avg,
            'count' => $count,
            'sum' => $sum,
        ];
    }

    public function SelectColumnEORM(){
//        $data = Brand::select('brand_name')->get();
        $data = Brand::select('brand_name')->distinct()->get();
        return $data;
    }

    public function WhereClauseEORM(){
        //like, in, between
        $data = Brand::where('id', 1)->get();
        return $data;
    }

    public function OrderByClauseEORM(){
        $data = Brand::orderBy('id', 'desc')->get();
        return $data;
    }

    public function PaginationEORM(){
//        $data = Brand::simplePaginate(2);
        $data = Brand::paginate(
            $perPage = 10,
            $columns = ['*'],
            $pageName = 'ItemNumber',
        );
        return $data;
    }
    public function OneOneUserEORM(){
        $data = User::get();
//        $data = User::with('profile')->get();
        return $data;
    }
    public function OneOneRevProfileEORM(){
//        $data = Profile::get();
        $data = Profile::with('user')->get();
        return $data;
    }
    public function OneManyBrandEORM(){
//        $data = Brand::get();
        $data = Brand::with('product')->get();
        return $data;
    }
    public function OneOneProductEORM(){
//        $data = Product::get();
        $data = Product::with('brand')->get();
        return $data;
    }

}
