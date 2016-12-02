var bomon;
var ctdt;
var khoa_hoc;
$(document).ready(function(){
		//Gọi các hàm cấu hình ajax
		ajaxLoading();
		ajaxSetup();

		//gọi các hàm tải về 1 số biến cần thiết
		getListBomon();
	    getListKhoahoc();
	   getListCtdt()

		// Gọi các hàm xử lý đối với tree GV
		
		eventOpenUploadGv();
		eventOpenAddGV();
		eventGetListGV();

	    // Gọi các hàm xử lý đối với tree SV
	    eventOpenUploadSv();
	    getListSV();
	    eventOpenAddSV();
	    

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