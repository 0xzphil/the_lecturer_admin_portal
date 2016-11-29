<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'created_at', 'updated_at'
    ];

    /**
     * This attribute is primary key of user table
     * @var string
     */
    public $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];

    public function nhan_vien_khoa()
    {
        # code...
        return $this->hasOne('App\Nhan_vien_khoa');
    }

    public function giang_vien()
    {
        # code...
        return $this->hasOne('App\Giang_vien');
    }
    public function sinh_vien(){
        return $this->hasOne('App\Sinh_vien');
    }
}
