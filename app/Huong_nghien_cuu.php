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
    public $timestamps = false;
    public function giang_vien()
    {
    	# code...
    	return $this->belongsTo('App\Giang_vien');
    }

    public function map()
    {
    	# code...
    	return $this->hasMany('App\Map');
    }
}

