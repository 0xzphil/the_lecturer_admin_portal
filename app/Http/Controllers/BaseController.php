<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Bo_mon;

use Session;
use App\Linh_vuc_co_ban;

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
    public function getSession(Request $request)
    {
    	# code...
    	Session::put('abd', 123);
    	$request->session()->put('abc', 124);
    	return Session::all();
    }

    public function getSession2()
    {
    	# code...
    	return Session::all();
    }
    
}
