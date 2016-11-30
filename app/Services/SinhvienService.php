<?php 
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Services\SendEmailService;
use App\User;
use App\Giang_vien;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\QueryException;
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

		$result = Excel::load($pathFile,function($reader){})->get();

		//$result = $result->toJson();
		for($i = 0 ; $i < $result->get(0)->count() ; $i++){
			try{
				
			}
			catch(\Exception $e){
				//echo "exception: ".$i ;
				continue;
			}
		}
	} 
	public function addOneGV(){
		try{
				
		}
		catch(\Exception $e){
				//echo "exception: ".$i ;
				return false;
		}
		
	}
}


