<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Excel;
use Session;
use Sismgr;
use App\Nhan_vien_khoa;
use App\Khoa;

class UserController extends Controller
{
    /**
    */
    public function index(){
    	return view('welcome');
    }
    
    /**
    */
    public function getExcelContent(){
    	$path = 'storage\app\file.xls';
        echo $path;
    	$abc =  Excel::load( $path, function($reader) {

		})->get();

        print_r($abc);
    }

    public function redirectAfterLogin(){
        if(isset(Auth::user()->role)){
            // create session variables

            if(Auth::user()->role == 'khoa'){
                $nhan_vien_khoa =  Nhan_vien_khoa::where('user_id','=', Auth::user()->id)->firstOrFail();
                $khoa_id =  $nhan_vien_khoa->khoa_id;
                $khoa = Khoa::find($khoa_id);
                //$khoa = Khoa::find(Session::get('khoa_id'));
                Session::put('ten_khoa', $khoa->ten_khoa);
                Session::put('khoa_id', $khoa_id);
                Session::put('name', Auth::user()->name);
               //echo $khoa->ten_khoa;
                return view('khoa2')->with('ten_khoa', $khoa->ten_khoa);
            }
            else if(Auth::user()->role == 'giang_vien'){
                $giang_vien = Auth::user()->giang_vien->user_id;
                Session::put('ma_giang_vien',Auth::user()->giang_vien->ma_giang_vien);
                return view('giang_vien.profile');
            }
            else if(Auth::user()->role == 'sinh_vien'){
                $sinh_vien = Auth::user()->sinh_vien->user_id;
                $linh_vuc_cbs = Sismgr::listLvcb();
                $bo_mons = Sismgr::listBomon();
                return view('sinh_vien.profile', compact('bo_mons', 'linh_vuc_cbs'));
            } else {
                return view('');
            }
        }
        else return redirect('/login');
    }

    private function sessionStart()
    {
        # code...
        $role = Auth::user()->role;
       // echo Auth::user()->role;
        if( $role!= 'giang_vien'){
            $khoa_id = Auth::user()->$role->khoa_id;
        } else {
            $khoa_id = Auth::user()->$role->bo_mon->khoa_id;
        }
        Session::put('khoa_id', $khoa_id);
    }
}
