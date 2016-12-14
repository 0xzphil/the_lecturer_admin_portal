<?php 
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\QueryException;

use App\Services\SendEmailService;
use App\Services\Helper\SinhvienInfo;
use App\Services\Helper\SinhvienInfo2;
use App\Services\Helper\DetaiInfo;
use App\Services\Helper\DanhgiaInfo;
use App\User;
use App\Sinh_vien;
use App\Giang_vien;
use App\Ctdt;
use App\Khoa_hoc;
use App\De_tai;

/**
* 
*/
class SinhvienService 
{
	
	function __construct()
	{
		# code...
	}
	public function handleFileExcel($pathFile){
		$return = "";
		$done = 0 ;
		$fail = 0 ;
		$result = Excel::load($pathFile,function($reader){})->get();

		for($i = 0 ; $i < $result->get(0)->count() ; $i++){
			try{
				$password = substr(hash('sha512',rand()),0,6);
				$user = new User();
				$user->name = $result->get(0)->get($i)->ten;
				$user->email = $result->get(0)->get($i)->ma.'@vnu.edu.vn';
				$user->role = "sinh_vien";
				$user->password = Hash::make($password);
				$user->created_at = Carbon::now();
				$user->updated_at = Carbon::now();
			    $user->save();
				$id =  $user->id;


				$sinh_vien = new Sinh_vien();
				$sinh_vien->ma_sinh_vien = $result->get(0)->get($i)->ma;
				$sinh_vien->khoa_hoc_id = $result->get(0)->get($i)->khoahoc;
				$sinh_vien->khoa_id = $result->get(0)->get($i)->khoa;
				$sinh_vien->ctdt_id = $result->get(0)->get($i)->ctdt;
				$sinh_vien->dang_ky = false;
				$sinh_vien->user_id = $id;

				$sinh_vien->save();

				$email = new SendEmailService();
				$email->basic_email("hieunm.hk@gmail.com",$password);

				$done++;

			}
			catch(\Exception $e){
				$fail++;
				continue;
			}
		}
		return '{"done":'.$done.',"fail":'.$fail.'}';
	} 
	public function addOneSV($ma_sinh_vien , $ten_sinh_vien , $khoa_hoc_id , $ctdt_id,$khoa_id){
		try{
				$password = substr(hash('sha512',rand()),0,6);
				$user = new User();
				$user->name = $ten_sinh_vien;
				$user->email = $ma_sinh_vien.'@vnu.edu.vn';
				$user->role = "sinh_vien";
				$user->password = Hash::make($password);
				$user->created_at = Carbon::now();
				$user->updated_at = Carbon::now();
			    $user->save();
				$id =  $user->id;

				$sinh_vien = new Sinh_vien();
				$sinh_vien->ma_sinh_vien = $ma_sinh_vien;
				$sinh_vien->khoa_hoc_id = $khoa_hoc_id;
				$sinh_vien->khoa_id = $khoa_id;
				$sinh_vien->ctdt_id = $ctdt_id;
				$sinh_vien->dang_ky = false;
				$sinh_vien->user_id = $id;

				$sinh_vien->save();

				$email = new SendEmailService();
				$email->basic_email("hieunm.hk@gmail.com",$password);

				return true;

		}
		catch(\Exception $e){
				//echo "exception: ".$i ;
				return false;
		}
		
	}
	/*
	* hàm lấy thong tin sinh viên ra theo đối tượng SinhvienInfo trong thư mục helper
	*/
	public function getListJsonInfoSvByKhoaId($khoa_id){
		$result = array();
		$listSv = Sinh_vien::whereRaw('khoa_id = ?',[$khoa_id])->get();

		for($i = 0 ; $i < $listSv->count() ; $i++){
			$sinhvienInfo = new SinhvienInfo();
			$sinhvienInfo->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
			$sinhvienInfo->dang_ky = $listSv[$i]->dang_ky;
			$sinhvienInfo->ten_sinh_vien = $listSv[$i]->user->name;
			$sinhvienInfo->ctdt = $listSv[$i]->ctdt->mo_ta;
			$sinhvienInfo->khoa_hoc = $listSv[$i]->khoa_hoc->mo_ta;

			array_push($result, $sinhvienInfo);
		}
		return json_encode($result);
	}
	/* hàm lấy ra thông tin của các sinh viên được đăng ký đề tài*/
	public function getListJsonInfoSvByKhoaId2($khoa_id){
		$result = array();
		$listSv = Sinh_vien::whereRaw('khoa_id = ? and dang_ky = 1',[$khoa_id])->get();
		//return $listSv->count();
		for($i = 0 ; $i < $listSv->count();$i++){
			
			$sinhvienInfo2 = new SinhvienInfo2();

			$sinhvienInfo2->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
			$sinhvienInfo2->ten_sinh_vien = $listSv[$i]->user->name;
			$de_tai = De_tai::where('ma_sinh_vien','=',$listSv[$i]->ma_sinh_vien)->first();
			if($de_tai != null){
				if($de_tai->bao_ve == 1){
					continue;
				}
				$sinhvienInfo2->ten_de_tai = $de_tai->ten_de_tai;
				$sinhvienInfo2->ten_gv = $de_tai->giang_vien->user->name;
				
				$sinhvienInfo2->rut = $de_tai->rut;
				$sinhvienInfo2->sua = $de_tai->yeu_cau_sua;

				if($de_tai->yeu_cau_sua){
					$sinhvienInfo2->ten_de_tai2 = $de_tai->ten_de_tai2;
					$sinhvienInfo2->ten_gv2 = Giang_vien::find($de_tai->ma_giang_vien2)->user->name;
				}
				else{
					$sinhvienInfo2->ten_de_tai2 = "";
					$sinhvienInfo2->ten_gv2 = "";
				}

			}
			else{
				$sinhvienInfo2->ten_de_tai = "";
				$sinhvienInfo2->ten_gv = "";
				$sinhvienInfo2->rut = "";
				$sinhvienInfo2->sua = "";

				$sinhvienInfo2->ten_de_tai2 = "";
				$sinhvienInfo2->ten_gv2 = "";
			}

			array_push($result,$sinhvienInfo2);
		}
		return json_encode($result);
	}

	/*Hàm gửi email tới tất các sinh viên được vào danh sách đăng ký trong kỳ đăng ký đề tài nghiên cứu*/
	public function sendEmailToAllSvDk($context,$khoa_id){
		$listSv = Sinh_vien::whereRaw('khoa_id = ? and dang_ky=1',[$khoa_id])->get();
		//return $listSv->count();
		for($i = 0 ; $i < $listSv->count() ; $i++){
			$email = new SendEmailService();

			$email->notify_mail("hieunm.hk@gmail.com",$context);
		}

	}

	/*Lấy ra các đề tài sẽ được nộp hồ sơ bảo vệ bảo vệ*/
	public function getDetaiBaove($khoa_id){
		$result = array();

		$listSv = Sinh_vien::whereRaw('khoa_id = ?',[$khoa_id])->get();
		for($i = 0 ; $i < $listSv->count() ; $i++ ){

			$detaiInfo = new DetaiInfo();

			$de_tai = De_tai::where('ma_sinh_vien','=',$listSv[$i]->ma_sinh_vien)->first();
			if(isset($de_tai)){
				if( $de_tai->bao_ve != 1 || $de_tai->duoc_bao_ve == 1 || $de_tai->sau_bao_ve==1 ){
					continue;
				}
				else{
					$detaiInfo->ten_sinh_vien = $listSv[$i]->user->name;
					$detaiInfo->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
					$detaiInfo->ten_gv = $de_tai->giang_vien->user->name;
					$detaiInfo->ten_de_tai = $de_tai->ten_de_tai;
					$detaiInfo->ho_so = $de_tai->ho_so;
					$detaiInfo->hop_thuc = $de_tai->hop_thuc;
					$detaiInfo->hoan_tat = $de_tai->hoan_tat;

					$listDanhgia = array();

					$listDanhgia1 = $de_tai->danh_gia;
					for($j = 0 ; $j<$listDanhgia1->count();$j++){
						$temp = new DanhgiaInfo();
						$temp->ten_gvdg = $listDanhgia1[$j]->giang_vien->user->name;
						$temp->danh_gia = $listDanhgia1[$j]->nhan_xet;
						$temp->diem = $listDanhgia1[$j]->diem;
						array_push($listDanhgia,$temp);
					}

					$detaiInfo->listDanhgia =  $listDanhgia;

				}
				array_push($result,$detaiInfo);
			}
			else continue;

		}

		return json_encode($result);
	}

	/*Lấy ra các đề tài hoàn thiện hồ sơ và được bảo vệ*/
	public function getDetaiDbv($khoa_id){
		$result = array();

		$listSv = Sinh_vien::whereRaw('khoa_id = ?',[$khoa_id])->get();
		for($i = 0 ; $i < $listSv->count() ; $i++ ){

			$detaiInfo = new DetaiInfo();

			$de_tai = De_tai::where('ma_sinh_vien','=',$listSv[$i]->ma_sinh_vien)->first();
			if(isset($de_tai)){
				if( $de_tai->duoc_bao_ve != 1 || $de_tai->xuat_phan_cong == 1 ||$de_tai->sau_bao_ve==1 ){
					continue;
				}
				else{
					$detaiInfo->ten_sinh_vien = $listSv[$i]->user->name;
					$detaiInfo->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
					$detaiInfo->ten_gv = $de_tai->giang_vien->user->name;
					$detaiInfo->ten_de_tai = $de_tai->ten_de_tai;
					$detaiInfo->ho_so = $de_tai->ho_so;
					$detaiInfo->hop_thuc = $de_tai->hop_thuc;
					$detaiInfo->hoan_tat = $de_tai->hoan_tat;
					$detaiInfo->phan_cong = $de_tai->phan_cong;

					$listDanhgia = array();

					$listDanhgia1 = $de_tai->danh_gia;
					for($j = 0 ; $j<$listDanhgia1->count();$j++){
						$temp = new DanhgiaInfo();
						$temp->ten_gvdg = $listDanhgia1[$j]->giang_vien->user->name;
						$temp->danh_gia = $listDanhgia1[$j]->nhan_xet;
						$temp->diem = $listDanhgia1[$j]->diem;
						$temp->id = $listDanhgia1[$j]->id;
						$temp->ma_giang_vien = $listDanhgia1[$j]->ma_giang_vien;
						array_push($listDanhgia,$temp);
					}

					$detaiInfo->listDanhgia =  $listDanhgia;

				}
				array_push($result,$detaiInfo);
			}
			else continue;

		}

		return json_encode($result);
	}


	/* hàm gửi nhắc nhở tới các sinh viên trong khoa hoàn thiện hồ sơ để bảo vệ*/

	public function guinhacnho($khoa_id){
		$listSv = Sinh_vien::whereRaw('khoa_id = ?',[$khoa_id])->get();
		for($i = 0 ; $i < $listSv->count(); $i++){
			$de_tai = $listSv[$i]->de_tai;
			if(isset($de_tai)){
				if($de_tai->bao_ve == 1&&($de_tai->ho_so != 1 || $de_tai->hop_thuc != 1 || $de_tai->hoan_tat != 1) ){
					$sendmail = new SendEmailService();
					//$sendmail->notify_mail($listDt[$i]->ma_sinh_vien."@vnu.edu.vn")
					$sendmail->notify_mail('hieunm.hk@gmail.com',"Khoa xin thông báo! Hồ sơ bảo vệ tốt khóa luận tốt nghiệp của bạn chưa hoàn thành. Hãy đến văn phòng khoa hoàn tất trong thời gian sớm nhất");
				}
				else continue;
			}
			else continue;
		}
	}

	function getListXuatPhanCong($khoa_id){
		$result = array();

		$listSv = Sinh_vien::whereRaw('khoa_id = ?',[$khoa_id])->get();
		for($i = 0 ; $i < $listSv->count() ; $i++ ){

			$detaiInfo = new DetaiInfo();

			$de_tai = De_tai::where('ma_sinh_vien','=',$listSv[$i]->ma_sinh_vien)->first();
			if(isset($de_tai)){
				if($de_tai->phan_cong != 1 || $de_tai->xuat_phan_cong != 0){
					continue;
				}
				else{
					$detaiInfo->ten_sinh_vien = $listSv[$i]->user->name;
					$detaiInfo->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
					$detaiInfo->ten_gv = $de_tai->giang_vien->user->name;
					$detaiInfo->ten_de_tai = $de_tai->ten_de_tai;
					$detaiInfo->ho_so = $de_tai->ho_so;
					$detaiInfo->hop_thuc = $de_tai->hop_thuc;
					$detaiInfo->hoan_tat = $de_tai->hoan_tat;
					$detaiInfo->phan_cong = $de_tai->phan_cong;

					$listDanhgia = array();

					$listDanhgia1 = $de_tai->danh_gia;
					for($j = 0 ; $j<$listDanhgia1->count();$j++){
						$temp = new DanhgiaInfo();
						$temp->ten_gvdg = $listDanhgia1[$j]->giang_vien->user->name;
						$temp->danh_gia = $listDanhgia1[$j]->nhan_xet;
						$temp->diem = $listDanhgia1[$j]->diem;
						$temp->id = $listDanhgia1[$j]->id;
						$temp->ma_giang_vien = $listDanhgia1[$j]->ma_giang_vien;
						array_push($listDanhgia,$temp);
					}

					$detaiInfo->listDanhgia =  $listDanhgia;

				}
				array_push($result,$detaiInfo);
			}
			else continue;

		}
		return $result;
	}

	/*Hàm lấy ra dữ liệu cho danh sách bảo vệ ở tree Bảo vệ đề tài*/
	public function getDsbv($khoa_id){
		$result = array();

		$listSv = Sinh_vien::whereRaw('khoa_id = ?',[$khoa_id])->get();
		for($i = 0 ; $i < $listSv->count() ; $i++ ){

			$detaiInfo = new DetaiInfo();

			$de_tai = De_tai::where('ma_sinh_vien','=',$listSv[$i]->ma_sinh_vien)->first();
			if(isset($de_tai)){
				if($de_tai->xuat_phan_cong != 1 || $de_tai->sau_bao_ve == 1){
					continue;
				}
				else{
					$detaiInfo->ten_sinh_vien = $listSv[$i]->user->name;
					$detaiInfo->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
					$detaiInfo->ten_gv = $de_tai->giang_vien->user->name;
					$detaiInfo->ten_de_tai = $de_tai->ten_de_tai;
					$detaiInfo->ho_so = $de_tai->ho_so;
					$detaiInfo->hop_thuc = $de_tai->hop_thuc;
					$detaiInfo->hoan_tat = $de_tai->hoan_tat;
					$detaiInfo->phan_cong = $de_tai->phan_cong;
					$detaiInfo->chot_phan_bien = $de_tai->chot_phan_bien;

					$listDanhgia = array();

					$listDanhgia1 = $de_tai->danh_gia;
					for($j = 0 ; $j<$listDanhgia1->count();$j++){
						$temp = new DanhgiaInfo();
						$temp->ten_gvdg = $listDanhgia1[$j]->giang_vien->user->name;
						$temp->danh_gia = $listDanhgia1[$j]->nhan_xet;
						$temp->diem = $listDanhgia1[$j]->diem;
						$temp->id = $listDanhgia1[$j]->id;
						$temp->ma_giang_vien = $listDanhgia1[$j]->ma_giang_vien;
						array_push($listDanhgia,$temp);
					}

					$detaiInfo->listDanhgia =  $listDanhgia;

				}
				array_push($result,$detaiInfo);
			}
			else continue;

		}
		return json_encode($result);
	}

	/*Hàm lấy ra list danh sách đã chốt phân công để xuất excel*/
	function getListDsDiem($khoa_id){
		$result = array();

		$listSv = Sinh_vien::whereRaw('khoa_id = ?',[$khoa_id])->get();
		for($i = 0 ; $i < $listSv->count() ; $i++ ){

			$detaiInfo = new DetaiInfo();

			$de_tai = De_tai::where('ma_sinh_vien','=',$listSv[$i]->ma_sinh_vien)->first();
			if(isset($de_tai)){
				if($de_tai->chot_phan_bien != 1 || $de_tai->sau_bao_ve != 0){
					continue;
				}
				else{
					$detaiInfo->ten_sinh_vien = $listSv[$i]->user->name;
					$detaiInfo->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
					$detaiInfo->ten_gv = $de_tai->giang_vien->user->name;
					$detaiInfo->ten_de_tai = $de_tai->ten_de_tai;
					$detaiInfo->ho_so = $de_tai->ho_so;
					$detaiInfo->hop_thuc = $de_tai->hop_thuc;
					$detaiInfo->hoan_tat = $de_tai->hoan_tat;
					$detaiInfo->phan_cong = $de_tai->phan_cong;

					$listDanhgia = array();

					$listDanhgia1 = $de_tai->danh_gia;
					for($j = 0 ; $j<$listDanhgia1->count();$j++){
						$temp = new DanhgiaInfo();
						$temp->ten_gvdg = $listDanhgia1[$j]->giang_vien->user->name;
						$temp->danh_gia = $listDanhgia1[$j]->nhan_xet;
						$temp->diem = $listDanhgia1[$j]->diem;
						$temp->id = $listDanhgia1[$j]->id;
						$temp->ma_giang_vien = $listDanhgia1[$j]->ma_giang_vien;
						array_push($listDanhgia,$temp);
					}

					$detaiInfo->listDanhgia =  $listDanhgia;

				}
				array_push($result,$detaiInfo);
			}
			else continue;

		}
		return $result;
	}

	/*Lấy ra các đề tài sau bảo bệ*/
	public function getListSauBv($khoa_id){
		$result = array();

		$listSv = Sinh_vien::whereRaw('khoa_id = ?',[$khoa_id])->get();
		for($i = 0 ; $i < $listSv->count() ; $i++ ){

			$detaiInfo = new DetaiInfo();

			$de_tai = De_tai::where('ma_sinh_vien','=',$listSv[$i]->ma_sinh_vien)->first();
			if(isset($de_tai)){
				if($de_tai->sau_bao_ve==0 ){
					continue;
				}
				else{
					$detaiInfo->ten_sinh_vien = $listSv[$i]->user->name;
					$detaiInfo->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
					$detaiInfo->ten_gv = $de_tai->giang_vien->user->name;
					$detaiInfo->ten_de_tai = $de_tai->ten_de_tai;
					$detaiInfo->ho_so = $de_tai->ho_so;
					$detaiInfo->hop_thuc = $de_tai->hop_thuc;
					$detaiInfo->hoan_tat = $de_tai->hoan_tat;
					$detaiInfo->phan_cong = $de_tai->phan_cong;

					$listDanhgia = array();

					$listDanhgia1 = $de_tai->danh_gia;
					for($j = 0 ; $j<$listDanhgia1->count();$j++){
						$temp = new DanhgiaInfo();
						$temp->ten_gvdg = $listDanhgia1[$j]->giang_vien->user->name;
						$temp->danh_gia = $listDanhgia1[$j]->nhan_xet;
						$temp->diem = $listDanhgia1[$j]->diem;
						$temp->id = $listDanhgia1[$j]->id;
						$temp->ma_giang_vien = $listDanhgia1[$j]->ma_giang_vien;
						array_push($listDanhgia,$temp);
					}

					$detaiInfo->listDanhgia =  $listDanhgia;

				}
				array_push($result,$detaiInfo);
			}
			else continue;

		}

		return json_encode($result);
	}

}


