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
    	if($kiemTra == 1 || $kiemTra == 2 || $kiemTra == 8 ||  $kiemTra == 9){
    		return response()->json(['message' => 'fail', 'err'=> 'Gửi đề tài thất bại', 'numberCheck' => $kiemTra]);
    	} else 
    	if($kiemTra == 3 || $kiemTra == 4 || $kiemTra == 5 || $kiemTra == 6){
    		$this->editAndStore($request, $msv);
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
    	# nếu đóng đăng ký và có đề tài trong đó
    	if(Khoa::where('id', Session::get('khoa_id'))->first()->dang_ky == 0 && 
    		De_tai::where('ma_sinh_vien', $msv)->first() != NULL){
    		return 10;
    	}
    	# khoa chưa mở đăng ký
    	if(Khoa::where('id', Session::get('khoa_id'))->first()->dang_ky == 0){
    		return 1;
    	}
    	# không có quyền đăng ký
    	if(Auth::user()->sinh_vien->dang_ky == 0){
	    	return 2;
    	}
    	# Nếu đề tài đã có yêu cầu rút
	    if(De_tai::where('ma_sinh_vien', $msv)->first() != NULL
	    	&& De_tai::where('ma_sinh_vien', $msv)->first()->rut == 1){
	    	return 9;
	    }
	    # Nếu đề tài đã có yêu cầu chỉnh sửa 
	    if(De_tai::where('ma_sinh_vien', $msv)->first() != NULL
	    	&& De_tai::where('ma_sinh_vien', $msv)->first()->yeu_cau_sua == 1){
	    	return 8;
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
	    # đã có đề tài và giảng viên đồng ý tiếp nhận sinh viên này và đề tài không trùng
    	if(De_tai::where('ma_sinh_vien', $msv)->first() != NULL
    		&& De_tai::where('ma_sinh_vien', $msv)->first()->trang_thai_gv == 'dong_y'
    		&& De_tai::where('ma_sinh_vien', $msv)->first()->trung == 0){
	    	return 6;
	    }
	    # chưa có đề tài nào
	    return 7;
    }

    public function kiemTraHoSo()
    {
    	# code...
    	
    	$msv = Auth::user()->sinh_vien->ma_sinh_vien;
    	$check = $this->kiemTraDeTai($msv);
    	if($check!= 10){
    		return response()->json(['check'=> 1, 'kiemTraDeTai'=> $check]);
    	} else {
    		$deTai =  De_tai::where('ma_sinh_vien', $msv)->first();
    		return response()->json(['check'=> 2, 'deTai'=> $deTai]);
    	}
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
     * [editAndStore description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function editAndStore($request, $msv)
    {
    	# code...
    	$deTai = De_tai::where('ma_sinh_vien', $msv)->first();
    	$deTai->ma_giang_vien2 = $request->get('ma_giang_vien');
    	$deTai->ten_de_tai2    = $request->get('ten_de_tai');
    	//$deTai->trang_thai_gv  = 'chua_xac_nhan';
    	$deTai->yeu_cau_sua    = 1;
    	$deTai->save();
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
    /**
     * [rutDangKy description]
     * @return [type] [description]
     */
    public function rutDangKy()
    {
    	# code...
    	$msv = Auth::user()->sinh_vien->ma_sinh_vien;
    	if(De_tai::where('ma_sinh_vien', $msv)->first() != NULL){
	    	$deTai = De_tai::where('ma_sinh_vien', $msv)->first();
	    	$deTai->rut = 1;
	    	$deTai->save();
	    }
	    return response()->json(['message' => 'Rút thành công']);
    }
    /**
     * [listDeTai description]
     * @param  [type] $ma_giang_vien [description]
     * @return [type]                [description]
     */
    public function listDeTai()
    {
    	# code...
    	$mgv = Auth::user()->giang_vien->ma_giang_vien;
    	if($mgv != NULL){
    		return De_tai::where('ma_giang_vien', $mgv)->where('trang_thai_gv', 'chua_xac_nhan')->get();
    	}
    }
    /**
     * [listDeTaiDaChapNhan description]
     * @return [type] [description]
     */
    public function listDeTaiDaChapNhan()
    {
    	# code...
    	$mgv = Auth::user()->giang_vien->ma_giang_vien;
    	if($mgv != NULL){
    		return De_tai::where('ma_giang_vien', $mgv)->where('trang_thai_gv', 'dong_y')->get();
    	}
    }
    /**
     * [chapNhan description]
     * @param  [type] $ma_sinh_vien [description]
     * @return [type]               [description]
     */
    public function chapNhan($ma_sinh_vien)
    {
    	# code...
    	# 
    	$deTai = De_tai::where('ma_sinh_vien', $ma_sinh_vien)->first();
    	$mgv = Auth::user()->giang_vien->ma_giang_vien;
    	if( $mgv == $deTai->ma_giang_vien){
    		$deTai->trang_thai_gv = 'dong_y';
    		$deTai->save();
    		return $this->listDeTai();
    	} else return 0;
    }
    /**
     * [tuChoi description]
     * @param  [type] $ma_sinh_vien [description]
     * @return [type]               [description]
     */
    public function tuChoi($ma_sinh_vien)
    {
    	# code...
    	# 
    	$deTai = De_tai::where('ma_sinh_vien', $ma_sinh_vien)->first();
    	$mgv = Auth::user()->giang_vien->ma_giang_vien;
    	if( $mgv == $deTai->ma_giang_vien){
    		$deTai->trang_thai_gv = 'tu_choi';
    		$deTai->save();
    		return $this->listDeTai();
    	} else return 0;
    }

    public function doiTTTrung($ma_sinh_vien)
    {
    	# code...
    	$deTai = De_tai::where('ma_sinh_vien', $ma_sinh_vien)->first();
    	$mgv = Auth::user()->giang_vien->ma_giang_vien;
    	if( $mgv == $deTai->ma_giang_vien){
    		if($deTai->trung == 0){
    			$deTai->trung = 1;
    		} else {
    			$deTai->trung = 0;
    		}
    		$deTai->save();
    		return $this->listDeTaiDaChapNhan();
    	} else return 0;
    }
}
