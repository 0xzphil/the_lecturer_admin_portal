<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danh_gia extends Model
{
    protected $fillable = [
    	'de_tai_id',
    	'nhan_xet',
    	'diem',
    	'ma_giang_vien'
    ];

    public $timestamps = false;

    public function de_tai(){
    	return $this->belongsTo('App\De_tai');
    }
    public function giang_vien(){
    	return $this->belongsTo('App\Giang_vien','ma_giang_vien','ma_giang_vien');
    }
}
