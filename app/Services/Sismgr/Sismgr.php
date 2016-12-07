<?php 

namespace App\Services\Sismgr;
use Auth;
use Session;
use App\Giang_vien;
use App\Linh_vuc_co_ban;
use App\Linh_vuc;
use App\Bo_mon;
use App\Khoa;
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

    public function listLv()
    {
    	# code...
    	return Linh_vuc::all();
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

    public function soLuongGv()
    {
    	# code...
    	return Khoa::join('bo_mons', 'khoas.id', '=', 'bo_mons.khoa_id')->join('giang_viens', 'bo_mons.id', '=', 'giang_viens.bo_mon_id')->count();
    }
}




