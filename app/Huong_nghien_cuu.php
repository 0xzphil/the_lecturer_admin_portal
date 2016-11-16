<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Huong_nghien_cuu extends Model
{
    //
    protected $fillable = [
    	'ten_huong_nghien_cuu',
    	'mo_ta',
    	'linh_vuc_id',
    	'ma_giang_vien'
    ];
}
