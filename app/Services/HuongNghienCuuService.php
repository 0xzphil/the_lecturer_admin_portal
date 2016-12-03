<?php 
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Map;
use App\Huong_nghien_cuu;

/**
* 
*/
class HuongNghienCuuService
{
	
	function __construct()
	{
		# code...
	}
	 public function addHNC($tenHNC,$mota,$listLinhVucIQ){
	 	try{
	 		$hnc=new Huong_nghien_cuu;
	 		$hnc->ten_huong_nghien_cuu = $tenHNC;
	 		$hnc->mo_ta = $mota;
	 		$hnc->ma_giang_vien = Session::get('ma_giang_vien');
	 		$hnc->save();
	 		$id = $hnc->id;
	 		$listLinhVuc = explode(",", $listLinhVucIQ);
	 		for($i = 0 ; $i < count($listLinhVuc) ; $i++) {
	 			# code...
	 			$map = new Map;
	 			$map->linh_vuc_id = $listLinhVuc[$i];
	 			//echo "linh vuc id:".$map->linh_vuc_id;

	 			$map->huong_nghien_cuu_id = $id;
	 			//echo "hnc:".$map->huong_nghien_cuu_id;
	 			$map->save(); 
	 			//var_dump($map);

	 		}

	 		return true;

	 	}
	 	catch(\Exception $e){
				//echo "exception: ".$i ;
				return false;
	 	}
	 }

	
}


