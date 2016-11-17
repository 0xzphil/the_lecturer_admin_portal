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

    public function giang_vien()
    {
    	# code...
    	return $this->belongsTo('App\Giang_vien');
    }

    public function linh_vuc()
    {
    	# code...
    	return $this->belongsTo('App\Linh_vuc');
    }
}

