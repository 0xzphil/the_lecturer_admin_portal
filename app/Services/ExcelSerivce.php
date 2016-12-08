<?php 
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
* 
*/
class ExcelService 
{
	
	function __construct()
	{
		# code...
	}
	public function exportListSvDt($khoa_id){
		$listSv = Sinh_vien::whereRaw('khoa_id = ? and dang_ky = 1', [$khoa_id])->get();
		
		for($i = 0 ; $i < $listSv->count(); $i++){

		}
	}
}