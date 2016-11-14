<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

class UserController extends Controller
{
    /**
    */
    public function index(){
    	return view('index');
    }
    
    /**
    */
    public function getExcelContent(){
    	$path = 'storage\app\file.xls';
    	return Excel::load( $path, function($reader) {

		})->get();
    }
}
