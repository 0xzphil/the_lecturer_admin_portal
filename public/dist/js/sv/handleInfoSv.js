$(document).ready(function() {
	infoSV()
});


function infoSV() {
	// body...
	$('#infoSV').click(function(event) {
		/* Act on the event */
		infoGet();
	});
}

function infoGet() {
	// body...
	J2lib.ajaxGet('basicInfo', function (data) {
		// body...
		basicInfo(data);
	})
}

function basicInfo(data) {
	// body...
	console.log(data);
	$('#main-content').empty();
		var dkContent; 
		if(data[0].dang_ky * data[0].dang_ky2 ==1){
			dkContent = '<span class="label label-success">Được đăng ký</span>';
		} else {
			dkContent = '<span class="label label-danger">Không được phép đăng ký</span>';
		}
		var passwordContent = '<section class="content">\
      <div class="row">\
      <meta name="csrf_token" content="{!! csrf_token() !!}"/>\
          <div class="content">\
          <!-- Profile Image -->\
          <div class="box box-primary" id="gvcontent">\
            <div class="box-body box-profile">\
              <img class="profile-user-img img-responsive img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture">\
              <p class="text-muted text-center">Sinh viên</p>\
              <h3 class="profile-username text-center">'+ data[0].name +'</h3>\
              \
              <ul class="list-group list-group-unbordered">\
                <li class="list-group-item">\
                  <b>Mã sinh viên</b> <a class="pull-right">'+ data[0].ma_sinh_vien +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Email</b> <a class="pull-right">'+ data[0].email +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Khoa</b> <a class="pull-right">'+ data[0].ten_khoa +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Khóa học</b> <a class="pull-right">'+ data[0].khoa_hoc +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Chương trình đào tạo</b> <a class="pull-right">'+ data[0].chuong_trinh_dao_tao +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Đăng ký đề tài khóa luận tốt nghiệp</b> <a class="pull-right">'+ dkContent +'</a>\
                </li>\
              </ul>\
            </div>\
            <!-- /.box-body -->\
          </div>\
          <!-- /.box -->\
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
