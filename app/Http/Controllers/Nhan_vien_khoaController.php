<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GiangVienService;
use App\Services\SendEmailService;
use App\Services\SinhvienService;
use App\Services\QldtService;
use App\Services\WordService;
use App\Services\ExcelService;
use Illuminate\Support\Facades\Input;
use App\Giang_vien;
use App\Khoa;
use App\Bo_mon;
use App\User;
use App\Sinh_vien;
use App\Khoa_hoc;
use App\Ctdt;
use Session;
use Auth;
use Response;


class Nhan_vien_khoaController extends Controller
{   
     /**
      * Hàm upload danh sách giảng viên bằng file excel
      */
     public function uploadGV() {
        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message
        Session::flash('success', 'Upload successfully'.$destinationPath.$fileName.$extension); 
        $giangvienService = new GiangVienService();
        return  $giangvienService->handleFileExcel("uploads/". $fileName );
        //return Redirect::to('upload');
        // $sendMail = new SendEmailService();
        // $password = substr(hash('sha512',rand()),0,6); 
        // $sendMail->basic_email('hieunm.hk@gmail.com', $password);
        
    }


    /**
     * Hàm lấy ra danh sách giảng viên trong khoa hiện tại
     */
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

    /**
     * Hàm lấy danh sách bộ môn trong khoa
     */
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
      $extension = Input::file('exSV')->getClientOriginalExtension();

      $fileName = rand(11111,99999).'.'.$extension; 
      Input::file('exSV')->move($destinationPath, $fileName); 
      Session::flash('success', 'Upload successfully'.$destinationPath.$fileName.$extension); 
      
      $sinhvienService = new SinhvienService();
      $result =  $sinhvienService->handleFileExcel("uploads/". $fileName );  
      return $result;
    }

    /**
     * Hàm lấy ra danh sách sinh viên trong khoa
     */
    public function getListSV(){
        $sinhvienService = new SinhvienService();
        return $sinhvienService->getListJsonInfoSvByKhoaId(Session::get('khoa_id'));
    }


    /**
     * Hàm lấy ra list khóa học
     */
    public function getListKhoahoc(){
        return json_encode(Khoa_hoc::all());
    }

    /**
     * Hàm lấy ra list Chương trình đào tạo
     */
    public function getListCtdt(){
        return json_encode(Ctdt::all());
    }

    //Hàm thêm mới 1 tài khoản sinh viên vào DB
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

    // Hàm thêm 1 khóa học
    public function addKhoahoc($khoa_hoc1){
      try {
        $khoa_hoc = new Khoa_hoc();
        $khoa_hoc->mo_ta = $khoa_hoc1;
        $khoa_hoc->save();
        return "true";
      } catch (Exception $e) {
        return "false";
      }
    }

    //Hàm thêm mới 1 Chương trình đào tạo
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

    /**
     * Hàm upload danh sách các sinh viên được đăng ký đề tài 
     */
    public function uploadKt(){
      $destinationPath = 'uploads'; // upload path
      $extension = Input::file('exKt')->getClientOriginalExtension();

      $fileName = rand(11111,99999).'.'.$extension; 
      Input::file('exKt')->move($destinationPath, $fileName); 
      
      $qldtService = new QldtService();
      $result =  $qldtService->handleFileExcel("uploads/". $fileName );  
      return $result;
    }
    /**
     * Hàm chuyển trạng thái sinh viên sang được đăng ký
     */
    function addSVDDK($ma_sinh_vien){
        try {
            $sinh_vien = Sinh_vien::find($ma_sinh_vien);
            $sinh_vien->dang_ky = 1;
            $sinh_vien->save();
            return "true";
        } catch (\Exception $e) {
          return "false";
        }
    }

    function openTimeDk(){
      $khoa_id = Session::get('khoa_id');
      try {
          $context = Input::get('message-all');
          $sinhvienService = new SinhvienService();
          $sinhvienService->sendEmailToAllSvDk($context,$khoa_id);
          $khoa =  Auth::user()->nhan_vien_khoa->khoa;
          $khoa->dang_ky = 1;
          $khoa->save();
          return "true";
      } catch (Exception $e) {
          return "false";
      }

    }

    function svanddt(){
       $sinhvienService = new SinhvienService();
       $khoa_id = Session::get('khoa_id');
       return $sinhvienService->getListJsonInfoSvByKhoaId2($khoa_id);
       //return $sinhvienService->getListJsonInfoSvByKhoaId2($khoa_id);
    }

    // hàm này ko có ý nghĩa , chỉ để test hệ thống
    function closeTimeDk1(){
        $wordService = new WordService();
        $wordService->xuat_cong_van1('hello',"Công nghệ thông tin",40,"dkdt2016.xlsx");
        //return Response::download('hello.docx');
        return 'ok';
        // $wordService->xuat_cong_van2('qdtRut',"CÔNG NGHỆ THÔNG TIN","14020169","Nguyễn Minh Hiếu","Đề tài nghiên cứu số 1", "PGS.TS Phạm Ngọc Hùng");
        // return Response::download('qdtRut.docx', 'qdtRut.docx');

      // $wordService->xuat_cong_van3('qdtSua',"CÔNG NGHỆ THÔNG TIN","14020169","Nguyễn Minh Hiếu","Đề tài nghiên cứu số 1", "PGS.TS Phạm Ngọc Hùng","PGS.TS Phạm Ngọc Hùng","Đề tài số 2");
      //   return Response::download('qdtSua.docx', 'qdtSua.docx');
      // $excelService = new ExcelService();
      // $excelService->exportListSvDt("1");
      // $file= public_path(). "/download/excel/test1.xlsx";
      // return Response::download($file);
     // return Response::download('../download/excel/test1.xlsx');
      //return 'ok';
    }

    function closeTimeDk(){
        $excelService = new ExcelService();
        $excelService->exportListSvDt("danh_sach_khoa_CNTT" ,"1");
        return "ok";
    }
}
