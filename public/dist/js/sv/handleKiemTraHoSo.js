$(document).ready(function() {
	kiemTraHoSo();
});

function kiemTraHoSo() {
	// body...
	$('#kiemTraHoSo').click(function () {
		// body...
		J2lib.ajaxGet('kiemTraHoSo', function (data) {
			// body...
			xuLiNoiDungKt(data);
		});
	});
}

function xuLiNoiDungKt(data) {
	// body...
	console.log(data);
	$('#content').empty();
	var content;
	if(data.check == 1){
		content = 'Chưa hoàn thiện quá trình đăng ký. Không thể xem trạng thái hồ sơ';
	}
	if(data.check == 2){
		var ho_so;
		if(data.deTai.ho_so == 1){
			ho_so = '<span class="label label-success">Đã nộp hồ sơ</span>';
		} else ho_so = '<span class="label label-danger">Chưa nộp hồ sơ</span>';

		var hoan_tat;
		if(data.deTai.hoan_tat == 1){
			hoan_tat = '<span class="label label-success">Đã hoàn tất hồ sơ</span>';
		} else hoan_tat = '<span class="label label-danger">Chưa hoàn tất hồ sơ</span>';

		var hop_thuc;
		if(data.deTai.hop_thuc == 1){
			hop_thuc = '<span class="label label-success">Đã hợp thức</span>';
		} else hop_thuc = '<span class="label label-warning">Hồ chưa chưa hợp thức</span>';

		content = '<div class="col-md-12" id="info2">\
	          <div class="box">\
	            <div class="box-header">\
	              <h3 class="box-title">Hồ sơ của đề tài '+ data.deTai.ten_de_tai +'</h3>\
	            </div>\
	            <div class="box-body box-profile">\
	            <ul class="list-group list-group-unbordered">\
	                <li class="list-group-item">\
	                  <b>Mã giảng viên hướng dẫn đề tài</b> <a class="pull-right">'+ data.deTai.ma_giang_vien +'</a>\
	                </li>\
	                <li class="list-group-item">\
	                  <b>Mã sinh viên thực hiện đề tài</b> <a class="pull-right">'+ data.deTai.ma_sinh_vien +'</a>\
	                </li>\
	                <li class="list-group-item">\
	                  <b>Nộp hồ sơ </b> <a class="pull-right">'+ ho_so +'</a>\
	                </li>\
	                <li class="list-group-item">\
	                  <b>Hợp thức hồ sơ</b> <a class="pull-right">'+ hop_thuc +'</a>\
	                </li>\
	                <li class="list-group-item">\
	                  <b>Hoàn tất hồ sơ</b> <a class="pull-right">'+ hoan_tat +'</a>\
	                </li>\
	              </ul>\
	        	  </div>\
	            </div>\
	          </div>\
	          <!-- /.box -->\
	        </div>';
	    }
    $('#content').append(content);
}
