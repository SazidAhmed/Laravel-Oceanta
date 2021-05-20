<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestOrder extends Model
{
    protected $fillable = ['name','phone','address','note','cart'];
}
