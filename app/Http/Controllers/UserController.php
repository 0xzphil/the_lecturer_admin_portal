<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Excel;
use Session;
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
            if(Auth::user()->role == 'khoa'){
                $test =  Nhan_vien_khoa::where('user_id','=',Auth::user()->id)->firstOrFail();
                $khoa_id =  $test->khoa_id;
                $khoa = Khoa::find($khoa_id);
                Session::put('khoa_id', $khoa_id);
                Session::put('name', Auth::user()->name);
               //echo $khoa->ten_khoa;
                return view('khoa2')->with('ten_khoa',$khoa->ten_khoa);
            }
            else{
                return view('giangvien');
            }
        }
        else return redirect('/login');
    }
}
