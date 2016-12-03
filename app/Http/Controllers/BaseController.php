<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Bo_mon;
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

    public static function listLvcb()
    {
    	# code...
    	return Linh_vuc_co_ban::all();
    }

    public static function getListGv()
    {
        # code...
        return Giang_vien::all();
    }

}
