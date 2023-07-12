<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $table='categories';
       //$table describes the name of the database

    protected $fillable=[
          'name',
          'slug',
          'description',
          'image',
          'meta_keyword',
          'meta_description',
          'status',
    ];
    public function products(){

return $this->hasMany(Product::class,'category_id','id');

    }
    public function relatedproducts(){

return $this->hasMany(Product::class,'category_id','id')->latest();

    }
    public function brands(){
        return $this->hasMany(Brand::class,'category_id','id')->where('status','0');
    }

};
