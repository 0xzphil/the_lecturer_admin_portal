<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ctdt extends Model
{
    protected $fillable = ['mo_ta'];
    public $timestamps = false;

    public function sinh_vien(){
    	return $this->hasMany('App\Sinh_vien');
    }
}
