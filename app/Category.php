<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subcategory;
class Category extends Model
{
	
    protected $fillable = ['name','slug','image'];

    public function subcategory(){
    	return $this->hasMany(Subcategory::class);
    }
}
