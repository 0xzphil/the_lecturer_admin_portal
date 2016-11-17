<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GiangVienService;
use App\Services\SendEmailService;
use Illuminate\Support\Facades\Input;
use Session;

class Nhan_vien_khoaController extends Controller
{
     public function uploadGV() {
        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message
        Session::flash('success', 'Upload successfully'.$destinationPath.$fileName.$extension); 
        $giangvienService = new GiangVienService();
        $giangvienService->handleFileExcel("uploads/". $fileName );
        //return Redirect::to('upload');
        $sendMail = new SendEmailService();
        $password = substr(hash('sha512',rand()),0,6); 
        $sendMail->basic_email('hieunm.hk@gmail.com', $password);
  }
}
