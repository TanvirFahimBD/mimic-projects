<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['brand_name', 'brand_img'];

    function product(){
        return $this->hasMany(Product::class);
    }
}
