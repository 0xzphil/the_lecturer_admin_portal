<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Giang_VienRequest;
use App\Http\Requests\PasswordRequest;
use App\User;
use App\Services\HuongNghienCuuService;
use Auth;

class Huong_Nghien_CuuController extends Controller
{
    public function addHNC($tenHNC,$mota,$listLinhVucIQ){
        //echo $listLinhVucIQ;
         $hncService = new HuongNghienCuuService();
         $result = $hncService->addHNC($tenHNC,$mota,$listLinhVucIQ);
         if($result == true){
          return 'true';
         }
         else{
          return 'false';
         }
    }

}