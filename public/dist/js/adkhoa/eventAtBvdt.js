
/*Hàm click vào danh sách bảo vệ*/
var detaibaove1;
function clickDsbv(){
	$('#dsbvdt1').click(function(){
		$.get('getDsbv',function(data,status){
			if(status == 'success'){
				$object = JSON.parse(data);
					console.log($object);
					detaibaove1 = $object;
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
	                </tr>\
	                </thead>\
	                <tbody>';
					for($i = 0 ; $i < $object.length ; $i++){
						$html += ' <tr class="row-bv1">\
						        <td>'+($i+1)+'</td>\
						        <td>'+$object[$i].ma_sinh_vien+'</td>\
						        <td>'+$object[$i].ten_sinh_vien+'</td>\
						        <td>'+$object[$i].ten_de_tai+'</td>\
						      </tr>';
					}
					$html += "</tbody></table></div></div></section>";
					$("#main-content").empty();
					$("#main-content").append($html);
					$("#tb-bv").DataTable();
					clickRowBv1();
			}
		});
	});
}
/*Xử lý click row sự kiện trên Danh sách bảo vệ*/
function clickRowBv1(){
	$('.row-bv1').click(function(){
		var child  = $(this).children();
		var ma_sinh_vien = child[1].innerHTML;
		
		for($i = 0 ; $i < detaibaove1.length ; $i++){
			if(ma_sinh_vien == detaibaove1[$i].ma_sinh_vien){
				sinh_vien = detaibaove1[$i];
				break;
			}
		}
		$('#main-content').empty();
			$html = '<h3 style="margin-left:10px;">Thông tin đề tài và phản biện</h3>\
				<div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Thông tin sinh viên và đề tài</h3>\
            </div>\
				<form class="form-horizontal">\
				 <div class="box-body">\
                	<div class="form-group">\
				      <label class="col-sm-2 control-label">Mã sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="pcmsv1" type="text" value="'+ma_sinh_vien+'" disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên sinh viên</label>\
				      <div class="col-sm-8">\
				        <input id="pbtsv" class="form-control" type="text" value="'+sinh_vien.ten_sinh_vien+'"  disabled="disabled">\
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
				        <textarea id="pbtdt" class="form-control" rows="2" disabled="disabled">'+sinh_vien.ten_de_tai+'</textarea>\
				      </div>\
				    </div>\
             </div> </form></div></div>';

        	$html += '<section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box box-primary">\
            <div class="box-header with-border">\
              <h2 class="box-title col-lg-8">Phần phản biện</h2>\
              </div>\
            <div class="box-body">\
              <table id="tb-pc" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>STT</th>\
                  <th>Tên giảng viên</th>\
                  <th>Đánh giá</th>\
                  <th>Điểm</th>\
                </tr>\
                </thead>\
                <tbody id="bodypc">';
				for($i = 0 ; $i < sinh_vien.listDanhgia.length ; $i++){
					$html += ' <tr class="row-pc"><input type="hidden" value="'+sinh_vien.listDanhgia[$i].id+'">\
					        <td>'+($i+1)+'</td>\
					        <td>'+sinh_vien.listDanhgia[$i].ten_gvdg+'</td>'+
					        '<td>'+(sinh_vien.listDanhgia[$i].danh_gia != "" ? sinh_vien.listDanhgia[$i].danh_gia : "Chưa có")+'</td>'+
					        '<td>'+(sinh_vien.listDanhgia[$i].diem != 0 ? sinh_vien.listDanhgia[$i].diem : "Chưa có")+'</td>'+
					        '</tr>';
				}
				$html += "</tbody></table></div></div></section>";
	        $("#main-content").append($html);
			$('#tb-pc').DataTable();
			clickRowPC();
	});
}

function clickRowPC(){
	$('.row-pc').click(function(){
		$('#pb-ten-de-tai').val($('#pbtdt').val());

		var child  = $(this).children();
		$('#pb-ten-gv').val(child[2].innerHTML);
		$('#ip_dgpb').val((child[3].innerHTML));
		$('#pb-diem-de-tai').val(child[4].innerHTML);

		$('#modal10').modal('show');
	});
}