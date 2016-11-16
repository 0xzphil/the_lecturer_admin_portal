<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Excel;

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
                return view('khoa');
            }
            else{
                return view('giangvien');
            }
        }
        else return redirect('/login');
    }
}
