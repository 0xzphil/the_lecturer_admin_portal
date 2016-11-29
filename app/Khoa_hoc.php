<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khoa_hoc extends Model
{
    protected $fillable = ['mo_ta'];
    protected $timestamps = false;

    public function sinh_vien(){
    	return $this->hasMany('App\Sinh_vien');
    }
}
