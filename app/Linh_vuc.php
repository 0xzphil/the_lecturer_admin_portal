<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linh_vuc extends Model
{
    //
    protected $fillable = [
    	'ten_linh_vuc',
    	'mo_ta',
        'parent_id'
    ];
    public $timestamps = false;
    public function map()
    {
    	# code...
    	return $this->hasMany('App\Map');
    }

}
