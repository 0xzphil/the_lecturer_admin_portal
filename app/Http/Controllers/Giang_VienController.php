<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Giang_VienRequest;
use App\User;
use App\Giang_Vien;
use Auth;

class Giang_VienController extends Controller
{
    //
   	public function saveGV(Giang_VienRequest $request)
   	{
   		# code...
   		
   	}

   	public function editBasicInformation(Giang_VienRequest $request)
   	{
   		# code...
         # 
         $user = Auth::user();
         $user->name = $request->get('name');
         $user->email = $request->get('email');
         $giang_vien = Giang_Vien::where('ma_giang_vien', Auth::user()->giang_vien->ma_giang_vien)
            ->firstOrFail();
         $giang_vien->ma_giang_vien = $request->get('mgv');
         //$giang_vien->email         = $request->get('email');
         //$giang_vien->name          = $request->get('name');
         $giang_vien->save();

   		return response()->json(['message'=> 'success']);
   	}
}
