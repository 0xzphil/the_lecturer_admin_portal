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

	    // gọi các hàm xử lí đối với tree khóa học và chường trình đào tạo
	    openKhoahoc();
	    openCtdt()

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
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
}
function ajaxSetup(){
	$.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
}