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

    protected $primaryKey = 'ma_giang_vien';
}
