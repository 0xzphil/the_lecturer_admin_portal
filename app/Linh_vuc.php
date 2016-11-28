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
    public $timestamps = false;
    public function map()
    {
    	# code...
    	return $this->hasMany('App\Map');
    }

}
