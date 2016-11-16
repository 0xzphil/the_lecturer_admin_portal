<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linh_vuc extends Model
{
    //
    protected $fillable = [
    	'ten_linh_vuc',
    	'mo_ta'
    ];

    public function huong_nghien_cuu()
    {
    	# code...
    	return $this->hasMany('App\Huong_nghien_cuu');
    }

}
