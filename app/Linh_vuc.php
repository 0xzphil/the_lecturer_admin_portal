<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linh_vuc extends Model
{
    //
    protected $fillable = [
    	'ten_linh_vuc',
    	'mo_ta'
    ];
}

/*	Config	Check GUI	1. Configure path of Dev-Cpp but it is wrong	Notify wrong path
	Config	Check GUI	1. Configure path of Z3 but it is wrong	Notify wrong path
	Config	Check GUI	"1. Configure path of Dev-Cpp 
2. Configure make command, gcc command, g++ command but it is wrong"	Notify errors if command is not exist
	Config	Check GUI	"1. Configure max lines in node to 1
2. Load C/C++ project"	CFG node is displayed exactly on 1 line
	Config	Check GUI	"1. Configure max characters in node to 3
2. Load C/C++ project"	CFG node has maximum 3 characters
	Config	Check GUI	"1. Configure node margin X to 1000
2. Load C/C++ project"	
	Config	Check GUI	"1. Configure node margin Y to 1000
2. Load C/C++ project"	*/