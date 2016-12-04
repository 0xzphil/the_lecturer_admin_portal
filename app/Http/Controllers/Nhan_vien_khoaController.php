<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GiangVienService;
use App\Services\SendEmailService;
use App\Services\SinhvienService;
use Illuminate\Support\Facades\Input;
use App\Giang_vien;
use App\Khoa;
use App\Bo_mon;
use App\User;
use App\Sinh_vien;
use App\Khoa_hoc;
use App\Ctdt;
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
        $listBo_mon = Bo_mon::where('khoa_id','=',Session::get('khoa_id'))->take(3000)->get();
        $listGV = array();
        foreach ($listBo_mon as $value) {
            //echo $value;
            $temp = Giang_vien::where('bo_mon_id','=', $value->id)->take(3000)->get();
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

    // xử lý sự kiện nhân viên khoa up file excel khởi tạo tài khoản sinh viên
    public function uploadSV(){
      $destinationPath = 'uploads'; // upload path
      $extension = Input::file('exSV')->getClientOriginalExtension(); // getting image extension
      
      $fileName = rand(11111,99999).'.'.$extension; // renameing image
        Input::file('exSV')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message
        Session::flash('success', 'Upload successfully'.$destinationPath.$fileName.$extension); 
        $sinhvienService = new SinhvienService();
        $result =  $sinhvienService->handleFileExcel("uploads/". $fileName );
        //return Redirect::to('upload');
        // $sendMail = new SendEmailService();
        // $password = substr(hash('sha512',rand()),0,6); 
        // $sendMail->basic_email('hieunm.hk@gmail.com', $password);
        return $result;
    }

    public function getListSV(){
        $sinhvienService = new SinhvienService();
        return $sinhvienService->getListJsonInfoSvByKhoaId(Session::get('khoa_id'));
    }

    public function getListKhoahoc(){
        return json_encode(Khoa_hoc::all());
    }

    public function getListCtdt(){
        return json_encode(Ctdt::all());
    }
    public function addSV($ma_sinh_vien , $ten_sinh_vien , $khoa_hoc , $ctdt){
      $sinhvienService = new SinhvienService();
      $result = $sinhvienService->addOneSV($ma_sinh_vien,$ten_sinh_vien,$khoa_hoc,$ctdt,Session::get('khoa_id'));
      if($result == true){
        return "true";
      }
      else {
        return "false";
      }
    }

    public function addKhoahoc($khoa_hoc1){
     // var_dump($khoa_hoc1);
      try {
        $khoa_hoc = new Khoa_hoc();
        $khoa_hoc->mo_ta = $khoa_hoc1;
        $khoa_hoc->save();
        return "true";
      } catch (Exception $e) {
        return "false";
      }
    }

    public function addCtdt($ctdt1){
      try {
        $ctdt = new Ctdt();
        $ctdt->mo_ta = $ctdt1;
        $ctdt->save();
        return 'true';
      } catch (Exception $e) {
        return 'false';
      }
    }
}
