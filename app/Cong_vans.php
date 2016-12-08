<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cong_vans extends Model
{
    protected $table = "cong_vans";

    protected $fillable = ['khoa_id','pathfile','pathattachfile','mo_ta'];

    public function khoa(){
    	return $this->belongsTo('App\Khoa');
    }
}
