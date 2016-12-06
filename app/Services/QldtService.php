<?php 
namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

use Excel;
use Carbon\Carbon;
use Hash;

use App\Services\SendEmailService;
use App\Sinh_vien;


/**
* 
*/
class QldtService 
{
	
	function __construct()
	{
		# code...
	}
	public function handleFileExcel($pathFile){
		$return = "";

		$result = Excel::load($pathFile,function($reader){})->get();

		$done = 0 ; 
		$fail = 0 ;
		
		for($i = 0 ; $i < $result->get(0)->count() ; $i++){
			try{
				$ma_sinh_vien = $result->get(0)->get($i)->ma;
				$sinhvien = Sinh_vien::find($ma_sinh_vien);
				$sinhvien->dang_ky = 1;
				$sinhvien->save();
				$done++;
			}
			catch(\Exception $e){
				$fail++;
				continue;
			}
		}

		return '{"done":'.$done.',"fail":'.$fail.'}';
	} 
	
}


