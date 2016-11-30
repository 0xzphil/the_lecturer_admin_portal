var bomon ;
$(document).ready(function(){
		//Gọi các hàm cấu hình ajax
		ajaxLoading();
		ajaxSetup();

		// Gọi các hàm xử lý đối với tree GV
		
		eventOpenUploadGv();
		eventOpenAddGV();
		eventGetListGV();
	    getListBomon();
	    

	    // Gọi các hàm xử lý đối với tree SV
	    eventOpenUploadSv();
	    

});


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