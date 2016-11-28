<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinh_vien extends Model
{
    protected $fillable = [
    	'ma_sinh_vien',
    	'dang_ky',
    	'khoa_hoc_id',
    	'ctdt_id',
    	'khoa_id'
    ];

    protected $timestamps = false;

    public function khoa_hoc(){
    	return $this->belongsTo('App\Khoa_hoc');
    }
    public function khoa(){
    	return $this->belongsTo('App\Khoa');
    }
    public function ctdt(){
    	return $this->belongsTo('App\Ctdt');
    }
    public function de_tai(){
    	return $this->hasMany('App\De_tai');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
