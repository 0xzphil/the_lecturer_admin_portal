<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cong_van extends Model
{
    protected $table = "cong_vans";

    protected $fillable = ['khoa_id','pathfile','pathattachfile','mo_ta'];
    public $timestamps = false;
    public function khoa(){
    	return $this->belongsTo('App\Khoa');
    }
}
