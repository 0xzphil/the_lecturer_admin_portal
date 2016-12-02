<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Bo_mon;
use App\Linh_vuc_co_ban;

class BaseController extends Controller
{
    //
    public function listBomon()
    {
    	# code...
    	$role = Auth::user()->role;
    	$listBo_mon = Bo_mon::whereRaw('khoa_id = ?',[Auth::user()->$role->khoa_id])->get();
       	echo $listBo_mon;
    }
    public function listLvcb(){
    	$listLvcd = Linh_vuc_co_ban::all();
    	return $listLvcd;
    }
}
