<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danh_gia extends Model
{
    protected $fillable = [
    	'de_tai_id',
    	'nhan_xet',
    	'diem'
    ];

    protected $timestamps = false;

    public function de_tai(){
    	return $this->belongsTo('App\De_tai');
    }
}
