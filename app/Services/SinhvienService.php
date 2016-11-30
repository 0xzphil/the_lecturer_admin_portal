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
		$done = 0 ;
		$fail = 0 ;
		$result = Excel::load($pathFile,function($reader){})->get();

		for($i = 0 ; $i < $result->get(0)->count() ; $i++){
			try{
				$password = substr(hash('sha512',rand()),0,6);
				$user = new User();
				$user->name = $result->get(0)->get($i)->ten;
				$user->email = $result->get(0)->get($i)->ma;
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
				$sinh_vien->dangky = false;
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
		return "{'done':".$done.",'fail':".$fail."}";
	} 
	public function addOneSV(){
		try{
				
		}
		catch(\Exception $e){
				//echo "exception: ".$i ;
				return false;
		}
		
	}
}


