<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    //
    protected $fillable = [
    	'ten_khoa', 
    	'chu_nhiem_khoa', 
    	'mo_ta', 
    	'van_phong_khoa'
    ];
}
