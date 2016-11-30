<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GiangVienService;
use App\Services\SendEmailService;
use Illuminate\Support\Facades\Input;
use App\Giang_vien;
use App\Khoa;
use App\Bo_mon;
use App\User;
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
        // $sendMail = new SendEmailService();
        // $password = substr(hash('sha512',rand()),0,6); 
        // $sendMail->basic_email('hieunm.hk@gmail.com', $password);
        return redirect('/');
    }

    public function getListGV(){
        $listBo_mon = Bo_mon::where('khoa_id','=',Session::get('khoa_id'))->take(10)->get();
        $listGV = array();
        foreach ($listBo_mon as $value) {
            //echo $value;
            $temp = Giang_vien::where('bo_mon_id','=', $value->id)->take(10)->get();
           //echo $temp;
           foreach ($temp as $value2) {
               $value2->ten_bo_mon = $value->ten_bo_mon;
               array_push($listGV,$value2);
           }
        }
       foreach ($listGV as $value) {
           # code...
           $user = User::find($value->user_id);
          
           $value->name = $user->name;
           $value->email = $user->email;
       }
       $response = "";
       $response .= "[";
        for($i = 0 ; $i < count($listGV); $i++){
            if($i == count($listGV)-1){
                $response .= $listGV[$i]->toJson();
            }
            else{
                $response .= $listGV[$i]->toJson().',';
            }
        }
       $response .= "]  ";
        //$response->header('Content-Type', 'text/html; charset=utf-8');
       echo $response;
    }

    public function getListBomon(){
       $listBo_mon = Bo_mon::whereRaw('khoa_id = ?',[Session::get('khoa_id')])->get();
       echo $listBo_mon;
    }

    /**
     * @param [type]
     * @param [type]
     * @param [type]
     * @param [type]
     */
    public function addGV($ma_giang_vien,$ten_giang_vien,$email,$bomon){

         $giangvienService = new GiangVienService();
         $result = $giangvienService->addOneGV($ma_giang_vien, $ten_giang_vien , $email,$bomon);
         if($result == true){
          return 'true';
         }
         else{
          return 'false';
         }
    }
    
}
