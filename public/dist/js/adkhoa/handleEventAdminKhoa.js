var bomon ;
$(document).ready(function(){
		ajaxLoading();
		eventOpenUploadGv();
		eventOpenAddGV();
		eventGetListGV();
	    getListBomon();
	    //console.log(window.bomon);
	    

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