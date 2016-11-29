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
    public $timestamps = false;
    public function nhan_vien_khoa()
    {
    	# code...
    	return $this->hasMany('App\Nhan_vien_khoa');
    }

    public function phong_thi_nghiem()
    {
    	# code...
    	return $this->hasMany('App\Phong_thi_nghiem');
    }

    public function bo_mon()
    {
    	# code...
    	return $this->hasMany('App\Bo_mon');
    }
    public function sinh_vien(){
        return $this->hasMany('App\Sinh_vien');
    }
}
