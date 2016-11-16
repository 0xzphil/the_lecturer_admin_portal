<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhan_vien_khoa extends Model
{
    //
    protected $fillables = [
    	'user_id',
    	'khoa_id'
    ];

    public function khoa()
    {
    	# code...
    	return $this->belongsTo('App\Khoa');
    }

    public function user()
    {
    	# code...
    	return $this->belongsTo('App\User');
    }
}
