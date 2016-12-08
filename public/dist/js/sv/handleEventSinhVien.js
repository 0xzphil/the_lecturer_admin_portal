
var data;

$(document).ready(function() {
	//var info = '#info1';
    //window.history.pushState({page: info}, null, info);
	nhapDeTai();
});

/*$(window).on('popstate',function(e){
    var state = e.originalEvent.state;
    if(state != null){
        if(state.hasOwnProperty('window')){
            //callback on window
            window[state.window].call(window,state);
        }
    }
});
*/

function getListBomon(argument) {
	// body...
	
}

function layDeTai() {
	// body...
	J2lib.ajaxGet('layDeTai', function (data) {
		// body...
		formTrangThaiFunc(data);
	});
}


function nhapDeTai() {
	
	// body...
  	var gvdata = $.parseJSON($('#gvdata').val());
	$('#open-de-tai').click(function () {
		$('#content').empty();
	    var optionHtml = '';
	    for (var i = gvdata.length - 1; i >= 0; i--) {
			if (i == gvdata.length - 1) {
				optionHtml += '<option selected="selected" value="'+ gvdata[i].ma_giang_vien +'">'+ gvdata[i].name +'</option>\n';
			} else 
				optionHtml += '<option value="'+ gvdata[i].ma_giang_vien +'">'+ gvdata[i].name +'</option>\n';
	    }
		var formDeTai = formDeTaiFunc(optionHtml);

	    $('#content').append(formDeTai);
		layDeTai();

	    $(function () {
			//Initialize Select2 Elements
	    	$(".select2").select2();
	    });

	    $('#chon-gv').change(function() {
			/* Act on the event */
			console.log($('#chon-gv').val());
    	});
    	$('#rutDangKy').click(function () {
    		// body...
    		console.log(window.history);
    	});
    	$('#xacNhanDeTai').click(function (argument) {
    		// body...
    		J2lib.ajaxPost('formId', 'guiDeTai', function () {
    			layDeTai();
    		});
    		
    	});

    });
}


function formDeTaiFunc(optionHtml) {
	// body...
	return '<div class="col-md-8">\
	<div class="box box-warning">\
    <div class="box-header with-border">\
      <h3 class="box-title">Đăng ký đề tài</h3>\
      <div class="box-tools pull-right">\
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>\
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>\
      </div>\
    </div>\
    <!-- /.box-header -->\
    <div class="box-body">\
        	<form id="formId">\
          <div class="form-group">\
            <label>Tên giảng viên</label>\
            <select class="form-control select2" name="ma_giang_vien" id="chon-gv" style="width: 100%;">'
              + optionHtml +
            '</select>\
          </div>\
          <!-- /.form-group -->\
          <div class="form-group">\
              <label>Tên đề tài</label>\
              <textarea class="form-control" rows="3" name="ten_de_tai" placeholder="Nhập tên đề tài ..."></textarea>\
            </div>\
          <!-- /.form-group -->\
          	</form>\
        </div>\
        <div class="box-footer">\
            <button type="submit" id="xacNhanDeTai" class="btn btn-primary">Gửi đề tài</button>\
        </div>\
        </div>';
}

function formTrangThaiFunc(data) {
	console.log(data);
	$('#info2').remove();
	var contentHtml;
	if(data.check == 7){
		contentHtml = '';
	} else {
		var trang_thai_giang_vien;
	if(data.sv.trang_thai_gv == 'chua_xac_nhan'){
		trang_thai_giang_vien = '<span class="label label-warning">Chưa xác nhận</span>';
	} else 
	if(data.sv.trang_thai_gv == 'dong_y'){
		trang_thai_giang_vien = '<span class="label label-success">Đồng ý</span>';
	} else 
	if(data.sv.trang_thai_gv == 'tu_choi'){
		trang_thai_giang_vien = '<span class="label label-danger">Từ chối</span>';
	};
	var trung;
	if(data.sv.trung == 1){
		trung = '<span class="label label-danger">Trùng đề tài</span>';
	} else trung = '<span class="label label-success">Không trùng</span>';

	contentHtml =  '<div class="col-md-4" id="info2">\
          <div class="box">\
            <div class="box-header">\
              <h3 class="box-title">Trạng thái đề tài của bạn</h3>\
            </div>\
            <div class="box-body box-profile">\
            <ul class="list-group list-group-unbordered">\
                <li class="list-group-item">\
                  <b>Mã giảng viên</b> <a class="pull-right">'+ data.sv.ma_giang_vien +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Mã sinh viên</b> <a class="pull-right">'+ data.sv.ma_sinh_vien +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Tên đề tài</b> <a class="pull-right">'+ data.sv.ten_de_tai +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Quyết định giảng viên</b> <a class="pull-right">'+ trang_thai_giang_vien +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Trạng thái trùng</b> <a class="pull-right">'+ trung +'</a>\
                </li>\
              </ul>\
              \
            <!-- /.box-body -->\
            <button type="submit" id="rutDangKy" class="btn btn-danger btn-flat">Rút đăng ký</button>\
        	</div>\
            </div>\
          </div>\
          <!-- /.box -->\
        </div>';
    }
    $('#content').append(contentHtml);
}