<?php 
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

/**
* 
*/
class SendEmailService
{
	
	function __construct()
	{
		# code...
	}
	 public function basic_email($email, $passOfAccount){
	     $data = array('password'=>$passOfAccount);
	      Mail::send('mail', $data, function($message) use($email) {
	         $message->to($email)->subject
	            ('Password login thesismgr system');
	         $message->from('hieusonson9x@gmail.com','khoa');
	      });
	      //echo "HTML Email Sent. Check your inbox.";
   }

	
}


