<?php 
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

use App\Sinh_vien;
use App\De_tai;
use App\Giang_vien;
use App\User;
use App\Services\Helper\SinhvienInfo2;

/**
* 
*/
class ExcelService 
{
	
	function __construct()
	{
		# code...
	}
	public function exportListSvDt($filename, $khoa_id){
		$listSv = Sinh_vien::whereRaw('khoa_id = ? and dang_ky=1', [$khoa_id])->get();

		// Phần lấy ra danh sách các đề tài được phép đăng ký bảo vệ
		$result = array();
		for($i = 0 ; $i < $listSv->count(); $i++){
			$temp = new SinhvienInfo2();
			$temp->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
			$temp->ten_sinh_vien = $listSv[$i]->user->name;

			$de_tai = De_tai::where('ma_sinh_vien','=',$listSv[$i]->ma_sinh_vien)->first();
			if(isset($de_tai)){
				if($de_tai->trang_thai_gv != 'dong_y' || $de_tai->trung == 1 || $de_tai->yeu_cau_sua == 1 || $de_tai->rut == 1 || $de_tai->ten_de_tai == null ||$de_tai->bao_ve == 1){
					continue;
				}
				else{
					$temp->ten_de_tai = $de_tai->ten_de_tai;
					$temp->ten_gv = Giang_vien::find($de_tai->ma_giang_vien)->user->name;
					$de_tai->bao_ve = 1;
					$de_tai->save();
				}
			}
			else{
				continue;
			}
			array_push($result, $temp);
		} 

		// Phần tạo file excel 
		Excel::create($filename, function($excel) use($result) {

		    $excel->sheet('Sheet1', function($sheet) use($result) {
		    	$sheet->appendRow(array(
				    'Mã sinh viên', 'Tên sinh viên','Giảng viên hướng dẫn','Tên đề tài'
				));
				for($i = 0 ; $i < count($result); $i++){
					$sheet->appendRow(array(
				    $result[$i]->ma_sinh_vien, $result[$i]->ten_sinh_vien,$result[$i]->ten_gv,
				    $result[$i]->ten_de_tai
				));
				}
			});

		})->store('xlsx', storage_path('../public/download/excel'));
	}

	public function exportListBv($filename , $khoa_id){
		$listSv = Sinh_vien::whereRaw('khoa_id = ? and dang_ky=1', [$khoa_id])->get();

		// Phần lấy ra danh sách các đề tài được phép đăng ký bảo vệ
		$result = array();
		for($i = 0 ; $i < $listSv->count(); $i++){
			$temp = new SinhvienInfo2();
			$temp->ma_sinh_vien = $listSv[$i]->ma_sinh_vien;
			$temp->ten_sinh_vien = $listSv[$i]->user->name;

			$de_tai = $listSv[$i]->de_tai;
			if(isset($de_tai)){
				if($de_tai->bao_ve != 1 || $de_tai->ho_so!=1 || $de_tai->hop_thuc != 1 || $de_tai->duoc_bao_ve == 1 || $de_tai->sau_bao_ve == 1 ){
					continue;
				}
				else{
					$temp->ten_de_tai = $de_tai->ten_de_tai;
					$temp->ten_gv = Giang_vien::find($de_tai->ma_giang_vien)->user->name;
					$de_tai->duoc_bao_ve = 1;
					$de_tai->save();
				}
			}
			else{
				continue;
			}
			array_push($result, $temp);
		} 

		// Phần tạo file excel 
		Excel::create($filename, function($excel) use($result) {

		    $excel->sheet('Sheet1', function($sheet) use($result) {
		    	$sheet->appendRow(array(
				    'DANH SÁCH SINH VIÊN ĐƯỢC BẢO VỆ'
				));
		    	$sheet->appendRow(array(
				    'Mã sinh viên', 'Tên sinh viên','Giảng viên hướng dẫn','Tên đề tài'
				));
				for($i = 0 ; $i < count($result); $i++){
					$sheet->appendRow(array(
				    $result[$i]->ma_sinh_vien, $result[$i]->ten_sinh_vien,$result[$i]->ten_gv,
				    $result[$i]->ten_de_tai
				));
				}
			});

		})->store('xlsx', storage_path('../public/download/excel'));
	}
}