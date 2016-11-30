<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Bo_mon;

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
}
