<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Bo_mon;
use App\Linh_vuc;
use App\User;
use Session;
use App\Linh_vuc_co_ban;
use Sismgr;

class BaseController extends Controller
{
    //
    public static function listBomon()
    {
    	# code...
    	$role = Auth::user()->role;
    	$listBo_mon = Bo_mon::whereRaw('khoa_id = ?', Session::get('khoa_id'))->get();
       	return $listBo_mon;
    }

    public function listLinhvuc()
    {
    	# code...
    	return Linh_vuc::all();
    }

    public static function listLvcb()
    {
    	# code...
    	return Linh_vuc_co_ban::all();
    }

    public function listGvbm($id)
    {
    	# code...
    	return Bo_mon::join('giang_viens', 'giang_viens.bo_mon_id', '=', 'bo_mons.id')->join('users', 'giang_viens.user_id', '=', 'users.id')->groupBy('users.id')->where('bo_mons.id', $id)->get();
    }

    public function listGvLv($id)
    {
    	# code...
    	return User::join('giang_viens', 'users.id', '=', 'giang_viens.user_id')->join('huong_nghien_cuus', 'huong_nghien_cuus.ma_giang_vien', '=', 'giang_viens.ma_giang_vien')->join('maps', 'huong_nghien_cuus.id', '=', 'maps.huong_nghien_cuu_id')->join('linh_vucs', 'linh_vucs.id', '=', 'maps.linh_vuc_id')->groupBy('users.id')->where('linh_vucs.id', $id)->get();
    }

    public static function getListGv()
    {
        # code...
        return Giang_vien::all();
    }

    public function infoGvById($id)
    {
    	# code...
    	return User::leftJoin('giang_viens', 'users.id', '=', 'giang_viens.user_id')->leftJoin('huong_nghien_cuus', 'huong_nghien_cuus.ma_giang_vien', '=', 'giang_viens.ma_giang_vien')->leftJoin('maps', 'huong_nghien_cuus.id', '=', 'maps.huong_nghien_cuu_id')->where('giang_viens.user_id', $id)->get(['giang_viens.ma_giang_vien', 'users.name', 'giang_viens.user_id', 'users.email', 'huong_nghien_cuus.ten_huong_nghien_cuu']);
    }
}
