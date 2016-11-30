<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Giang_VienRequest;
use App\Http\Requests\PasswordRequest;
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

      /**
       * [editBasicInformation description]
       * @param  Giang_VienRequest $request [description]
       * @return [type]                     [description]
       */
   	public function editBasicInformation(Giang_VienRequest $request)
   	{
   		# code...
         # 
         $user = Auth::user();
         $user->name = $request->get('name');
         $user->email = $request->get('email');
         $user->save();
         $giang_vien = Giang_Vien::where('ma_giang_vien', Auth::user()->giang_vien->ma_giang_vien)
            ->firstOrFail();
         $giang_vien->ma_giang_vien = $request->get('mgv');
         $giang_vien->save();

   		return response()->json(['message'=> 'success']);
   	}

      /**
       * [getBasicInformation description]
       * @return [type] [description]
       */
      public function getBasicInformation()
      {
         # code...
         $name          = Auth::user()->name;
         $ma_giang_vien = Auth::user()->giang_vien->ma_giang_vien;
         $email         = Auth::user()->email;
         return response()->json(['email'=> $email, 'name'=> $name, 'mgv'=> $ma_giang_vien]);
      }
      /**
       * [repass description]
       * @param  PasswordRequest $request [description]
       * @return [type]                   [description]
       */
      public function repass(PasswordRequest $request)
      {
         # code...
         $user = Auth::user();
         $user->password = Hash::make($request->get('new_pass'));
         return response()->json(['message'=> 'success']);
      }
}
