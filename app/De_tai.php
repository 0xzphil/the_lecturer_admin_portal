<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class De_tai extends Model
{
    protected $fillable = [
    	'ten_de_tai',
    	'ma_giang_vien',
    	'ma_sinh_vien',
    	'trang_thai_gv',
    	'trung',
    	'duoc_phep_sua_doi',
    	'ho_so',
    	'hop_thuc',
    	'hoan_tat',
    	'rut',
    	'qd_rut'
    ];

    public $timestamps = false;

    public function sinh_vien(){
    	return $this->belongsTo('App\Sinh_vien');
    }

    public function danh_gia(){
    	return $this->hasMany('App\Danh_gia');
    }
}
