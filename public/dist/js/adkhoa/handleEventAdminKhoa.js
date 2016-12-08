var bomon;
var ctdt;
var khoa_hoc;
var ten_khoa;
var slgv;
var slsv;
var slbm;
var slptn;
$(document).ready(function(){
		//Gọi các hàm cấu hình ajax
		ajaxLoading();
		ajaxSetup();

		//gọi các hàm tải về 1 số biến cần thiết
		saveInfoHome();
		getListBomon();
	    getListKhoahoc();
	   	getListCtdt();


		// Gọi các hàm xử lý đối với tree GV
		
		eventOpenUploadGv();
		eventOpenAddGV();
		eventGetListGV();

	    // Gọi các hàm xử lý đối với tree SV
	    eventOpenUploadSv();
	    getListSV();
	    eventOpenAddSV();

	    // gọi các hàm xử lí đối với tree khóa học và chường trình đào tạo
	    openKhoahoc();
	    openCtdt();
	    saveKhoahoc();
	    saveCtdt();

	    /**gọi các hàm ở tree quản lý đăng ký đề tài*/
	    	//hàm mở form khởi tạo bằng excel
		    openKhoitao();

		    //hàm mở list sinh viên được đăng ký đề tài và đề tài của họ
		    openSVDDK();

		    //Hàm lưu sinh viên vào sanh sách được đăng ký
		    addSVDDK();

		    //Hàm mở thời gian đăng ký đề tài cho các sinh viên đã ở trong danh sách
		    openTimeDK();

		    //Hàm đóng thời gian đăng kys
		    closeTimeDK();
	    /*Kết thúc các hàm quản lý tree đăng ký đề tài*/


});

//hàm tải về danh sách khóa học
function getListKhoahoc(){
	$.get('getListKhoahoc',function(data,status){
		if(status == 'success'){
			//console.log(data)
			khoa_hoc = JSON.parse(data);
			//console.log(khoa_hoc);
		}
	});
}

//hàm tải về danh sách khóa học
function getListCtdt(){
	$.get('getListCtdt',function(data,status){
		if(status == 'success'){
			ctdt = JSON.parse(data);
			//console.log(ctdt);
		}
	});
}

//Hàm validate email
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function ajaxLoading(){
	 $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
        //Pace.restart();
        console.log("start");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
        console.log("ajaxComplete");
    });
}
function ajaxSetup(){
	$.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
}
/*Hàm kiểm tra hợp thức mã sinh viên*/
function validateMSV(msv){
	if(msv.length != 8){
		return false;
	}
	else{
		return !isNaN(msv);
	}
}
/*
*	hàm lưu 1 số thông tin ở trang home
*/
function saveInfoHome(){
	$ten_khoa = $('#h1khoa').html();
	$slgv = $('#h3slgv').html();
	$slsv = $('#h3slsv').html();
	$slbm = $('#h3slbm').html();
	$slptn = $('#h3slptn').html();
	console.log($ten_khoa,$slptn,$slgv,$slsv,$slbm);
}
function appendContextHome(){
	
}
