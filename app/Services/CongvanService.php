<?php 
namespace App\Services;

use App\Cong_van;

class CongvanService {
	public function getListCvByKhoaId($khoa_id){
		return Cong_van::whereRaw('khoa_id = ?',[$khoa_id])->get();
	}
}	

 ?>