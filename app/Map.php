<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = [
    	'linh_vuc_id',
    	'huong_nghien_cuu_id'
    ];
    public $timestamps  = false;
    public function linh_vuc(){
    	return $this->belongsTo('App\Linh_vuc');
    }

    public function huong_nghien_cuu(){
    	return $this->belongsTo('App\Huong_nghien_cuu');
    }
}
