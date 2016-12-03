<?php 

namespace App\Services\Sismgr;
use Auth;
use Session;
use App\Giang_vien;
use App\Linh_vuc_co_ban;
use App\Bo_mon;

/**
* 
*/
class Sismgr 
{
	/**
	 * [listBomon description]
	 * @return [type] [description]
	 */
	public function listBomon()
    {
    	# code...
    	$role = Auth::user()->role;
    	$listBo_mon = Bo_mon::whereRaw('khoa_id = ?', Session::get('khoa_id'))->get();
       	return $listBo_mon;
    }

    /**
     * [listLvcb description]
     * @return [type] [description]
     */
    public function listLvcb()
    {
    	# code...
    	return Linh_vuc_co_ban::all();
    }

    /**
     * [getListGv description]
     * @return [type] [description]
     */
    public function listGv($format = null)
    {
        # code...
        if($format == 'form1'){
        	return $this->listRawGv()->select('name', 'ma_giang_vien', 'user_id')->get();
        }
        return $this->listRawGv()->get();
    }

    public function listRawGv()
    {
    	# code...
    	return Giang_vien::join('users', 'users.id', '=', 'giang_viens.user_id');
    }
}




