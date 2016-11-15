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
        echo $path;
    	$abc =  Excel::load( $path, function($reader) {

		})->get();

        print_r($abc);
    }
}
