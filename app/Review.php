<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['product_id','comment','name'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
