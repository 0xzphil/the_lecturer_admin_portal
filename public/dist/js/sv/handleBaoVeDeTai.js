$(document).ready(function() {
	kiemTraTrangThaiBaoVe();
});

function kiemTraTrangThaiBaoVe() {
	// body...
	$('#kiemTraTrangThaiBaoVe').click(function () {
		// body...
		J2lib.ajaxGet('kiemTraHoSo', function (data) {
			// body...
			xuLiNoiDungBv(data);
		});
	});
}

function xuLiNoiDungBv(data) {
	// body...
	console.log(data);
	$('#content').empty();
	var content;
	if(data.check == 1){
		content = 'Chưa hoàn thiện quá trình đăng ký. Không thể xem trạng thái bảo vệ';
	}
	if(data.check == 2){
		var bao_ve;
		if(data.deTai.bao_ve == 1){
			bao_ve = '<span class="label label-success">Bảo vệ</span>';
		} else bao_ve = '<span class="label label-danger">Chưa bảo vệ</span>';

		var duoc_bao_ve;
		if(data.deTai.duoc_bao_ve == 1){
			duoc_bao_ve = '<span class="label label-success">Được bảo vệ</span>';
		} else duoc_bao_ve = '<span class="label label-danger">Chưa được bảo vệ</span>';

		var sau_bao_ve;
		if(data.deTai.sau_bao_ve == 1){
			sau_bao_ve = '<span class="label label-success">Bảo vệ thành công</span>';
		} else sau_bao_ve = '<span class="label label-warning">Chưa bảo vệ thành công</span>';

		content = '<div class="col-md-12" id="info2">\
	          <div class="box">\
	            <div class="box-header">\
	              <h3 class="box-title">Trạng thái bảo vệ của đề tài '+ data.deTai.ten_de_tai +'</h3>\
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
	                  <b>Đăng ký bảo vệ đề tài</b> <a class="pull-right">'+ bao_ve +'</a>\
	                </li>\
	                <li class="list-group-item">\
	                  <b>Được bảo vệ đề tài</b> <a class="pull-right">'+ duoc_bao_ve +'</a>\
	                </li>\
	                <li class="list-group-item">\
	                  <b>Hoàn tất bảo vệ đề tài</b> <a class="pull-right">'+ sau_bao_ve +'</a>\
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
