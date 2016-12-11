
var data;
var dataDeTai;
var trangThaiClass = 4;

$(document).ready(function() {
	//var info = '#info1';
	nhapDeTai();
	layTrangThai();
	ajaxLoading();
});

function ajaxLoading(){
	 $(document).ajaxStart(function(){
        $("#wait").remove();
        var ajaxc = '   <div id="wait" class="alert alert-success" style="z-index: 1000; position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                  <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>';
        $('#main-content').append(ajaxc);
        //Pace.restart();
        console.log("start");
    });
    $(document).ajaxComplete(function(){
        $("#wait").remove();
    });
}

function layFormTrangThaiDeTai() {
	// body...
	J2lib.ajaxGet('layDeTai', function (data) {
		// body...
		formTrangThaiFunc(data);
	});
}

function layFormDangKy(gvdata) {
	// body...
	var optionHtml = '';
    for (var i = gvdata.length - 1; i >= 0; i--) {
		if (i == gvdata.length - 1) {
			optionHtml += '<option selected="selected" value="'+ gvdata[i].ma_giang_vien +'">'+ gvdata[i].name +'</option>\n';
		} else 
			optionHtml += '<option value="'+ gvdata[i].ma_giang_vien +'">'+ gvdata[i].name +'</option>\n';
    }
	
	if(dataDeTai.check == 7){
    	formDeTaiFunc(optionHtml);
	} else 
	if(dataDeTai.check == 1 || dataDeTai.check == 2 || dataDeTai.check == 8 || dataDeTai.check == 9){
		formCanhBaoFunc();
	} else 
	if(dataDeTai.check == 3 || dataDeTai.check == 4 || dataDeTai.check == 5 || dataDeTai.check == 6){
		formChinhSua(optionHtml);
	}
}

function initFormDangKy() {
	// body...
	var content = '<div class="col-md-8">\
		<div class="box box-warning">\
	    <div class="box-header with-border">\
	      <h3 class="box-title" id="formName">Đăng ký đề tài</h3>\
	      <div class="box-tools pull-right">\
	        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>\
	        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>\
	      </div>\
	    </div>\
	    <!-- /.box-header -->\
	    <div class="box-body" id="formDangKy">\
	    </div>\
	    <div class="box-footer" id="blockSubmit">\
	        <button type="submit" id="xacNhanDeTai" class="btn btn-primary">Gửi đề tài</button>\
	    </div>\
	    </div>';
    $('#content').append(content);
}

function checkDeTai(callback) {
	// body...
	J2lib.ajaxGet('layDeTai', function (data) {
		// body...
		
		checkDataDeTai(data);
		if(callback!= null){
			callback();
		}
	});
}

function checkDataDeTai(data) {
	// body...
	dataDeTai = data;
}

function layTrangThai() {
	// body...
	$('#open-trang-thai').click(function () {
		// body...
		$('#content').empty();
		layFormTrangThaiDeTai();
		checkDeTai(function () {
			editFormTrangThaiDeTai();
			layFormTrangThaiDeTai();	
		});
		function editFormTrangThaiDeTai() {
			// body...
			trangThaiClass = 12;
		}
		
	});
}

function nhapDeTai() {
	
	// body...
	
  	var gvdata = $.parseJSON($('#gvdata').val());
	$('#open-de-tai').click(function () {
		// initation
		trangThaiClass = 4;
		$('#content').empty();
		initFormDangKy();
		checkDeTai(function () {
			// body...	
			layFormDangKy(gvdata);
			layFormTrangThaiDeTai();

			(function () {
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
	    			console.log(gvdata);
	    			checkDeTai(function () {
		    			// body...
		    			layFormDangKy(gvdata);
		    			layFormTrangThaiDeTai();
	    			});
	    		});
	    		
	    	});
		});



    });
}


function formDeTaiFunc(optionHtml) {
	// body...
	$('#formDangKy').empty();
	var content = '<form id="formId">\
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
        ';
       $('#formDangKy').append(content);
}

function formCanhBaoFunc() {
	// body...
	$('#formDangKy').empty();
	var content;
	if(dataDeTai.check == 1){
		content = 'Sai thao tác. Khoa chưa mở đăng ký';
	} else 
	if(dataDeTai.check == 2){
		content = 'Sai thao tác. Bạn không có quyền đăng ký';
	} else 
	if(dataDeTai.check == 8){
		content = 'Bạn đang yêu cầu chỉnh sửa, bạn không thể gửi bất cứ đề tài nào nữa. <br/>Vui lòng chờ xác nhận từ nhân viên khoa. <br/> Nếu có yêu cầu gì, xin liên hệ khoa theo địa chỉ uet.vnu.edu.vn';
	} else 
	if(dataDeTai.check == 9){
		content = 'Bạn đã quyết định rút đăng ký. Bạn không thể gửi bất cứ đề tài nào nữa';
	}
	$('#blockSubmit').remove();
	$('#formDangKy').append(content);
}

function formChinhSua(optionHtml) {
	// body...
	var content = '<form id="formId">\
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
          	</form>';
    $('#formName').html('Chỉnh sửa đề tài');
    $('#xacNhanDeTai').html('Sửa đề tài');
	$('#formDangKy').empty();
	$('#formDangKy').append(content);
}

function formTrangThaiFunc(data) {
	$('#info2').remove();
	var contentHtml;
	var trangThaiClassContent;
	if(trangThaiClass == 4){
		trangThaiClassContent = 'col-md-4';
	} else {
		trangThaiClassContent = 'col-md-12';
	}
	console.log(data.check);

	if(data.check == 1){
		contentHtml ='<div class="'+ trangThaiClassContent + '" id="info2">\
          <div class="box">\
            <div class="box-header">\
              <h3 class="box-title">Trạng thái đề tài của bạn</h3>\
            </div>\
            <div class="box-body box-profile">\
              Khoa đóng đăng ký và bạn chưa có đề tài nào\
            </div>\
          </div>\
        </div>';
	} if(data.check == 2){
		contentHtml ='<div class="'+ trangThaiClassContent + '" id="info2">\
          <div class="box">\
            <div class="box-header">\
              <h3 class="box-title">Trạng thái đề tài của bạn</h3>\
            </div>\
            <div class="box-body box-profile">\
              Khoa đóng đã mở đợt đăng ký và bạn không đủ điều kiện đăng ký đề tài\
            </div>\
          </div>\
        </div>';
	} else if(data.check == 7){
		contentHtml ='<div class="'+ trangThaiClassContent + '" id="info2">\
          <div class="box">\
            <div class="box-header">\
              <h3 class="box-title">Trạng thái đề tài của bạn</h3>\
            </div>\
            <div class="box-body box-profile">\
              Bạn chưa có đề tài nào\
            </div>\
          </div>\
        </div>';
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
	var yeu_cau_sua;
	if(data.sv.yeu_cau_sua == 1){
		yeu_cau_sua = '<span class="label label-danger">Đã có yêu cầu sửa đổi</span>';
	} else yeu_cau_sua = '<span class="label label-success">Có thể gửi yêu cầu sửa đổi</span>';
	var rut;
	var rutButton = '';
	if(data.sv.rut == 1){
		rut = '<span class="label label-danger">Đã có yêu cầu rút</span>';
	} else {
		rutButton = '<button type="submit" id="rutDangKy" class="btn btn-danger btn-flat" value="rut">Rút đăng ký</button>';				
		rut = '<span class="label label-success">Chưa rút lần nào</span>';
	}
	contentHtml =  '<div class="'+ trangThaiClassContent + '" id="info2">\
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
                <li class="list-group-item">\
                  <b>Yêu cầu sửa đổi</b> <a class="pull-right">'+ yeu_cau_sua +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Yêu cầu rút đăng ký</b> <a class="pull-right">'+ rut +'</a>\
                </li>\
              </ul>\
              \
            <!-- /.box-body -->'+  rutButton
        	+'</div>\
            </div>\
          </div>\
          <!-- /.box -->\
        </div>';
    }
    $('#content').append(contentHtml);
    rutDangKy();
}


function rutDangKy() {
	// body...
	$('#rutDangKy').click(function () {
		// body.. .
		J2lib.ajaxGet('rutDangKy', function () {
			// body...
			checkDeTai(function () {
				// body...
				
  			var gvdata = $.parseJSON($('#gvdata').val());

		    			console.log('Sau khi an huy: '+ dataDeTai.check);
		    layFormDangKy(gvdata);
		    layFormTrangThaiDeTai();
			});
		});
	})
}