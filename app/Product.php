<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\ProductImage;
use App\Review;

class Product extends Model
{
    protected $fillable = ['name','section','description','image','price','stock','additional_info','category_id','subcategory_id'];

    public function category(){
    	return $this->hasOne(Category::class,'id','category_id');
    }

    public function subcategory(){
    	return $this->hasOne(Subcategory::class,'id','subcategory_id');
    }

    public function productImage(){
    	return $this->hasMany(ProductImage::class);
    }

    public function review(){
    	return $this->hasMany(Review::class);
    }
}
