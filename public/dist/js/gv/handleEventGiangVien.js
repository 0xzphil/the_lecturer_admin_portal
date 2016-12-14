
	
$(document).ready(function() {
	var dataGV;
	editGV();
	repassGV();
	//mo form thêm hướng nghiên cứu cho giảng viên
	
	openAddHnc();

	//tải về lĩnh vực cơ bản khi tải trang
	getListLinhVuc();
	//xư lí sự kiện khi ấn nút sửa
	openSuaHnc();
	//hàm xóa hướng nghiên cứu
	xoaHnc();

	//Xử lý sự kiện khi bấm vào mỗi nút xóa
	onclickXoa();
});

/**
 * [editGV description]
 * @return {[type]} [description]
 */
function editGV() {
	// body...
	var dataFunc = infoGV(function (data) {
		dataGV = data;
	});
	$('#editgv').click(function() {
		/* Act on the event */
		$('#gvcontent').empty();
		var editContent = '<div class="box-header wi-border">\
            <h3 class="box-title">Thông tin chỉnh sửa</h3>\
            </div>\
            <!-- /.box-header -->\
            <div class="box-body">\
              <form role="form">\
                <!-- text input -->\
                <div class="form-group">\
                  <label>Tên</label>\
                  <input type="text" id="gv_name" name="name" class="form-control" value="'+ dataGV.name +'">\
                </div>\
                <div class="form-group">\
                  <label>Mã giảng viên</label>\
                  <input type="text" id="gv_mgv" name="mgv" class="form-control" value="'+ dataGV.mgv +'">\
                </div>\
                <div class="form-group">\
                  <label>Email</label>\
                  <input type="email" id="gv_email" name="email" class="form-control" value="'+ dataGV.email +'">\
                </div>\
                <a href="#" class="btn btn-primary btn-block" id="confirmgv"><b>Xác nhận</b></a>\
                ';
		$('#gvcontent').append(editContent);
		confirmGV();
	});
}
/**
 * [infoGV description]
 * @param  {Function} callback [description]
 * @return {[type]}            [description]
 */
function infoGV(callback) {
	// body...
	$.ajax({
		url: 'infoGV',
		type: 'GET',
		dataType: 'json',
		//async: false,
	})
	.done(function(data) {
		//console.log(data);
		callback(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}
/**
 * [confirmGV description]
 * @return {[type]} [description]
 */
function confirmGV() {
	// body...
	$('#confirmgv').click(function() {
	    var name  = $('#gv_name').val();
	    var mgv   = $('#gv_mgv').val();
	    var email = $('#gv_email').val();
	    console.log(name);
		$.ajax({
	        url: "editGV",
	        type: "POST",
	        contentType : 'application/x-www-form-urlencoded',
	        beforeSend: function (xhr) {
	            var token = $('meta[name="csrf_token"]').attr('content');
	            if (token) {
	                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },
	        data: { name: name, email: email, mgv: mgv},

	        success: function(data){
	        	console.log(data);
	        }, 

	        error: function(data){
	        	var errors = $.parseJSON(data.responseText); 
	        	console.log(data);
	            console.log(data.responseText);
	        }
    	});
	});
}

function repassGV() {
	// body...
	$('#repass-gv').click(function(event) {
		/* Act on the event */
		repassAct();
		confirmPassword();
	});
}

function repassAct() {
	// body...
	$('#main-content').empty();
		var passwordContent = '<section class="content-header">\
      <h1>\
        Đổi mật khẩu\
      </h1>\
    </section>\
    <section class="content">\
    <section class="content">\
      <div class="row">\
        <div class="col-md-12">\
          <div class="box">\
    <div class="box-header with-border">\
            <h3 class="box-title">Chỉnh sửa mật khẩu</h3>\
            </div>\
            <!-- /.box-header -->\
            <div class="box-body">\
              <form role="form" id="form">\
                <!-- text input -->\
                <div class="form-group">\
                  <label>Mật khẩu cũ</label>\
                  <input type="text" id="old_pass" name="old_pass" class="form-control" placeholder="Nhập mật khẩu cũ...">\
                </div>\
                <div class="form-group">\
                  <label>Mật khẩu mới</label>\
                  <input type="text" id="new_pass" name="new_pass" class="form-control" placeholder="Nhập mật khẩu mới...">\
                </div>\
                <div class="form-group">\
                  <label>Nhập lại mật khẩu mới</label>\
                  <input type="email" id="renew_pass" name="renew_pass" class="form-control" placeholder="Xác nhận mật khẩu mới...">\
                </div>\
                <a href="#" class="btn btn-primary btn-block" id="confirmPassword"><b>Xác nhận</b></a>\
                </form>\
                </div>\
                </div>\
                </div>\
                </section>';
		$('#main-content').append(passwordContent);
}


function confirmPassword() {
	// body...
	
	$('#confirmPassword').click(function() {
	    J2lib.ajaxPost('form', 'repass', function (data) {
		// body...
			repassAct();
		});
	});
}
