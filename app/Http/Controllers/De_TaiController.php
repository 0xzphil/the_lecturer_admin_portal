<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\De_TaiRequest;

class De_TaiController extends Controller
{
    //
    public function guiDeTai(De_TaiRequest $request)
    {
    	# code...
    	if(Auth::user()->sinh_vien->dang_ky == 1){
    		// save()
    	}
    	return response()->json(['message' => $request->get('gvid')]);
    }
}
