/*
* @file: eventBv.js
* @author: Nguyễn Minh Hiếu
* @Chức năng: Xử lý sự kiện khi người dùng thao tác trên tree Bảo vệ
*/




/*
Hàm xử lý khi người dùng click vào danh sách bảo vệ
*/
var detaibaove;

function clickDsbvdt(){
	$('#dsbvdt').click(function(){
		$.get('listBv',function(data,status){
			if(status == 'success'){
				$object = JSON.parse(data);
				console.log($object);
				detaibaove = $object;
				$html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				  <section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box box-primary">\
            <div class="box-header with-border">\
              <h2 class="box-title col-lg-10">Danh sách đề tài được bảo vệ</h2>\
              </div>\
            <div class="box-body">\
              <table id="tb-bv" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>STT</th>\
                  <th>Mã sinh viên</th>\
                  <th>Tên sinh viên</th>\
                  <th>Đề tài</th>\
                  <th>Phản biện</th>\
                  <th>Chốt DSPB </th>\
                </tr>\
                </thead>\
                <tbody>';
				for($i = 0 ; $i < $object.length ; $i++){
					$html += ' <tr class="row-bv">\
					        <td>'+($i+1)+'</td>\
					        <td>'+$object[$i].ma_sinh_vien+'</td>\
					        <td>'+$object[$i].ten_sinh_vien+'</td>\
					        <td>'+$object[$i].ten_de_tai+'</td>\
					        <td>'+$object[$i].listDanhgia.length+'</td>\
					        <td>'+($object[$i].phan_cong == 1 ? "Xong":"Chưa xong")+'</td>\
					      </tr>';
				}
				$html += "</tbody></table></div></div></section>";
				$("#main-content").empty();
				$("#main-content").append($html);
				$("#tb-bv").DataTable();
				clickRowBv();
			}
		});
	});	
}

var sinh_vien;
function clickRowBv(){
	$('.row-bv').click(function(){
		var child  = $(this).children();
		var ma_sinh_vien = child[1].innerHTML;
		
		for($i = 0 ; $i < detaibaove.length ; $i++){
			if(ma_sinh_vien == detaibaove[$i].ma_sinh_vien){
				sinh_vien = detaibaove[$i];
				break;
			}
		}
		if(sinh_vien.phan_cong == 0){
			$('#main-content').empty();
			$html = '<h3 style="margin-left:10px;">Thông tin đề tài và phân công phản biện</h3>\
				<div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Thông tin sinh viên và đề tài</h3>\
            </div>\
				<form class="form-horizontal">\
				 <div class="box-body">\
                	<div class="form-group">\
				      <label class="col-sm-2 control-label">Mã sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="pcmsv" type="text" value="'+ma_sinh_vien+'" disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" type="text" value="'+sinh_vien.ten_sinh_vien+'"  disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Giảng viên hướng dẫn</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" type="text" value="'+sinh_vien.ten_gv+'"  disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên đề tài</label>\
				      <div class="col-sm-8">\
				        <textarea class="form-control" rows="2" disabled="disabled">'+sinh_vien.ten_de_tai+'</textarea>\
				      </div>\
				    </div>\
             </div> </form></div></div>';

        	$html += '<section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box box-primary">\
            <div class="box-header with-border">\
              <h2 class="box-title col-lg-8">Phân công phản biện đề tài</h2>\
              <button style="padding-right:10px" class="btn btn-success col-lg-2" id="btnchotdsbv" >Chốt danh sách phản biện</button>\
              <button class="btn btn-primary col-lg-2" data-toggle="modal" data-target="#modal7" >Thêm hội đồng phản biện</button>\
              </div>\
            <div class="box-body">\
              <table id="tb-pc" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>STT</th>\
                  <th>Tên giảng viên</th>\
                  <th>Tùy chọn</th>\
                </tr>\
                </thead>\
                <tbody id="bodypc">';
				for($i = 0 ; $i < sinh_vien.listDanhgia.length ; $i++){
					$html += ' <tr>\
					        <td>'+($i+1)+'</td>\
					        <td>'+sinh_vien.listDanhgia[$i].ten_gvdg+'</td>'+
					         '<td><button class="btn btn-danger xoapc">Xóa</button></td>'+
					        '</tr>';
				}
				$html += "</tbody></table></div></div></section>";
	        $("#main-content").append($html);
			$('#tb-pc').DataTable();
			clickBtnCdsbv();
		}
		else{
			$('#main-content').empty();
			$html = '<h3 style="margin-left:10px;">Thông tin đề tài và phân công phản biện</h3>\
				<div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Thông tin sinh viên và đề tài</h3>\
            </div>\
				<form class="form-horizontal">\
				 <div class="box-body">\
                	<div class="form-group">\
				      <label class="col-sm-2 control-label">Mã sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="pcmsv" type="text" value="'+ma_sinh_vien+'" disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" type="text" value="'+sinh_vien.ten_sinh_vien+'"  disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Giảng viên hướng dẫn</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" type="text" value="'+sinh_vien.ten_gv+'"  disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên đề tài</label>\
				      <div class="col-sm-8">\
				        <textarea class="form-control" rows="2" disabled="disabled">'+sinh_vien.ten_de_tai+'</textarea>\
				      </div>\
				    </div>\
             </div> </form></div></div>';

        	$html += '<section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box box-primary">\
            <div class="box-header with-border">\
              <h2 class="box-title col-lg-10">Phân công phản biện đề tài</h2>\
              \
              </div>\
            <div class="box-body">\
              <table id="tb-pc" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>STT</th>\
                  <th>Tên giảng viên</th>\
                </tr>\
                </thead>\
                <tbody id="bodypc">';
				for($i = 0 ; $i < sinh_vien.listDanhgia.length ; $i++){
					$html += ' <tr>\
					        <td>'+($i+1)+'</td>\
					        <td>'+sinh_vien.listDanhgia[$i].ten_gvdg+'</td></tr>';
				}
				$html += "</tbody></table></div></div></section>";
        $("#main-content").append($html);
		$('#tb-pc').DataTable();
		}
	});
}

/*Hàm xử lý sự kiện khi bấm lưu 1 phân công phản biện*/
function clickPc(){
	$('#btnphancong').click(function(){
		var msv = $('#pcmsv').val();
		var  mgv = $('#pc-mgv').val();
		//console.log(msv);
		if(mgv == ""){
			$('#pc-mgv').focus();
		}
		else{
			$('#modal7').modal('toggle');
			$.get('pcbv/'+msv+'/'+mgv,function(data, status){
				if(status == 'success'){
					console.log(data);
					if(data == "false"){
						createAlert('danger',"Mã giảng viên không tồn tại!");
					}
					else if(data == 'trung'){
						createAlert('danger',"Giảng viên đã được phân công vào đề tài này!");
					}
					else{
						createAlert('success',"Phân công thành công!");
						var stt =  $('#bodypc').children().length + 1;
						$html = '<tr>\
					        <td>'+stt+'</td>\
					        <td>'+data+'</td>'+
					        '<td><button class="btn btn-danger xoapc">Xóa</button></td>'+
					        '</tr>';
						$('#bodypc').append($html);
						
					}
				}
			});
		}
	});
}
/*Hàm xử lý khi bấm nút chốt danh sách phản biện đối với 1 sinh viên*/
function clickBtnCdsbv(){
	$('#btnchotdsbv').click(function(){
		$msv = $('#pcmsv').val();
		$('#h3chdsbv').append('   Khoa sẽ chốt danh sách bảo vệ đề tài của sinh viên: '+sinh_vien.ten_sinh_vien +" mã sinh viên: "+ $msv );
		$('#modal8').modal('show');
	});
}
/*Hàm xử lý lưu trạng thái đã phân công xong, chốt danh sách phản biện*/
function luuDspb1(){
	$('#luuDspb1').click(function(){
		$('#modal8').modal('toggle');
		$ma_sinh_vien = $('#pcmsv').val();
		$.get('luuDspb1/'+$ma_sinh_vien,function(data,status){
			if(status == 'success'){
				if(data == "true"){
					createAlert('success',"Chốt danh sách phản biện thành công!");
				}
				else{
					createAlert('danger',"Đã có lỗi xảy ra. Vui lòng thử lại sau!")
				}
			}
		});
	});
}

/* Hàm xử lý sự kiện Xuất danh dách đề nghị bảo vệ */
function clickXdndsbv(){
	$('#xdghdbv').click(function(){
		$('#modal9').modal('show');
	});
}

/*Hàm xử lý xuất phân công bảo vệ khi click vào nút xuất phân công*/
function clickBtnxpc(){
	$('#btnxpc').click(function(){
		$('#modal9').modal('toggle');
		$.get('xuatphancong',function(data,status){
			if(status == 'success'){
				console.log(data);
				if(data == 'true'){
					createAlert('success',"Xuất phân công thành công!");
				}
				else if(data == 'false'){
					createAlert('danger',"Không thành công! Tồn tại đề tài chưa chốt phân công!");
				}
				else{
					createAlert('danger','Đã có lỗi xảy ra. Thử lại sau!')
				}
			}
		});
	});
}