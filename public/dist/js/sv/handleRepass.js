$(document).ready(function() {
	repassSV()
});


function repassSV() {
	// body...
	$('#repass-sv').click(function(event) {
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
