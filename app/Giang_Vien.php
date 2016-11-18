<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giang_vien extends Model
{
    //
    protected $fillable = [
    	'ma_giang_vien',
    	'user_id',
    	'bo_mon_id'
    ];

    //protected $primaryKey = 'ma_giang_vien';

    public $timestamps = false;

    public function user()
    {
    	# code...
    	return $this->belongsTo('App\User');
    }

    public function bo_mon()
    {
    	# code...
    	return $this->belongsTo('App\Bo_mon');
    }

    public function huong_nghien_cuu()
    {
    	# code...
    	return $this->hasMany('App\Huong_nghien_cuu');
    }
}
