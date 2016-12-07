<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\De_TaiRequest;
use App\Khoa;
use Auth;
use Session;
use App\De_tai;

class De_TaiController extends Controller
{
	public $ma_sinh_vien;
	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		# code...
	}
	/**
	 * [layDeTai description]
	 * @return [type] [description]
	 */
	public function layDeTai()
	{
		# code...
		# 
		
    	$msv = Auth::user()->sinh_vien->ma_sinh_vien;
		$kiemTra = $this->kiemTraDeTai($msv);
		return response()->json(['sv' => De_tai::where('ma_sinh_vien', $msv)->first(), 'check' => $kiemTra]);
	}
    /**
     * [guiDeTai description]
     * logic gửi đề tài
     * @param  De_TaiRequest $request [description]
     * @return [type]                 [description]
     */
    public function guiDeTai(De_TaiRequest $request)
    {

    	$msv = Auth::user()->sinh_vien->ma_sinh_vien;
    	$kiemTra = $this->kiemTraDeTai($msv);
    	if($kiemTra == 1 || $kiemTra == 2 ){
    		return response()->json(['message' => 'fail', 'err'=> 'Gửi đề tài thất bại', 'numberCheck' => $kiemTra]);
    	} else 
    	if($kiemTra == 3 || $kiemTra == 4 || $kiemTra == 5 ){
    		$this->destroyAndStore($request, $msv);
    		return response()->json(['message' => 'refresh', 'err'=> 'Gửi lại đề tài thành công', 'numberCheck' => $kiemTra]);
    	} else
    	if($kiemTra == 7){
    		$this->store($request, $msv);
    		return response()->json(['message' => 'success', 'err'=> 'Gửi đề tài thành công', 'numberCheck' => $kiemTra]);
    	}
    	return De_tai::where('ma_sinh_vien', $msv)->first();
    }

    /**
     * [kiemTraDeTai description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function kiemTraDeTai($msv)
    {
    	# khoa chưa mở đăng ký
    	if(Khoa::where('id', Session::get('khoa_id'))->first()->dang_ky == 0){
    		return 1;
    	}
    	# không có quyền đăng ký
    	if(Auth::user()->sinh_vien->dang_ky == 0){
	    	return 2;
    	}
    	// 3 trạng thái giảng viên: tiếp nhận, từ chối và chưa phản hồi
    	# đã có đề tài và giảng viên từ chối tiếp nhận sinh viên này
    	if(De_tai::where('ma_sinh_vien', $msv)->first() != NULL
    		&& De_tai::where('ma_sinh_vien', $msv)->first()->trang_thai_gv == 'tu_choi'){
	    	return 3;
	    }
	    
	    # đã có đề tài và giảng viên chưa phản hồi
    	if(De_tai::where('ma_sinh_vien', $msv)->first() != NULL
    		&& De_tai::where('ma_sinh_vien', $msv)->first()->trang_thai_gv == 'chua_xac_nhan'){
	    	return 4;
	    }
	    # đã có đề tài và giảng viên đồng ý tiếp nhận sinh viên này và đề tài bị trùng
    	if(De_tai::where('ma_sinh_vien', $msv)->first() != NULL
    		&& De_tai::where('ma_sinh_vien', $msv)->first()->trang_thai_gv == 'dong_y'
    		&& De_tai::where('ma_sinh_vien', $msv)->first()->trung == 1){
	    	return 5;
	    }
	    # đã có đề tài và giảng viên đồng ý tiếp nhận sinh viên này và đề tài không trùng, sinh viên yêu cầu sửa đổi, và nhà trường chấp thuận
    	/*if(De_tai::where('ma_sinh_vien', $this->ma_sinh_vien)->first() != NULL
    		&& De_tai::where('ma_sinh_vien', $this->ma_sinh_vien)->first()->trang_thai_gv == 'dong_y'
    		&& De_tai::where('ma_sinh_vien', $this->ma_sinh_vien)->first()->trung == 0
    		&& De_tai::where('ma_sinh_vien', $this->ma_sinh_vien)->first()->duoc_phep_sua_doi == 0){
	    	return 6;
	    }*/
	    # chưa có đề tài nào
	    return 7;
    }

    /**
     * [store description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function store($request, $msv)
    {
    	# code...
    	$deTai = new De_tai();
    	$deTai->ma_giang_vien = $request->get('ma_giang_vien');
    	$deTai->ten_de_tai    = $request->get('ten_de_tai');
    	$deTai->ma_sinh_vien  = Auth::user()->sinh_vien->ma_sinh_vien;
    	$deTai->save();
    }

    /**
     * [edit description]
     * Chỉ sửa đổi nếu, giảng viên đã chấp nhận và các thuộc tính trùng không thỏa mãn và khoa chấp nhận yêu cầu sửa đổi 
     * Trường hợp này yêu cầu sửa đổi sẽ xóa bản ghi của sinh viên khỏi cơ sở dữ liệu nếu khoa chấp nhận
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function edit($value='')
    {
    	# code...
    }

    /**
     * [destroyAndStore description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function destroyAndStore($request, $msv)
    {
    	# code...
    	$this->deleteRow($msv);
    	$this->store($request, $msv);
    }

    /**
     * [deleteRow description]
     * @return [type] [description]
     */
    public function deleteRow($msv)
    {
    	# code...
    	De_tai::where('ma_sinh_vien', $msv)->first()->delete();
    }
}
