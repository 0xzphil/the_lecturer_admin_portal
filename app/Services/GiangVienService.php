<?php 
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

/**
* 
*/
class GiangVienService 
{
	
	function __construct()
	{
		# code...
	}
	public function handleFileExcel($pathFile){

		$result = Excel::load($pathFile,function($reader){})->get();

		//$result = $result->toJson();
		for($i = 0 ; $i < $result->get(0)->count() ; $i++){
			print_r($result->get(0)->get($i)->ma);
			echo "<br>";
			print_r($result->get(0)->get($i)->ten);
			echo "<br>";
			print_r($result->get(0)->get($i)->donvi);
			echo "<br>";
			print_r($result->get(0)->get($i)->email);
			echo "<br>";
			echo md5(uniqid(rand(), true));
			echo "<br>";
		}
	} 
}


