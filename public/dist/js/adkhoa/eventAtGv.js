//hàm chuyển chế độ sang chế độ upload file excel
function eventOpenUploadGv(){
	$_token = $('meta[name="csrf_token"]').attr('content');
	//console.log($_token);
	$('#open-upload-gv').click(function(){
		$("#main-content").empty();
		$text = '<br><div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Khởi tạo tài khoản giảng viên bằng file excel.</h3>\
            </div>\
			      <form class="form-horizontal" id="form-upload-GV" action="/uploadGV" method="post" enctype="multipart/form-data">\
			         <div class="box-body">\
			            <input id="file-upload-GV"  type="file" name="image" id="image" />\
			            <br>\
			            <input id = "btn-upload-GV" class="btn btn-info" type="button" value="Upload">'
			            + '<input type="hidden" name="_token" value="'+$_token+'" /> '+             
			      '<a href="/" class="btn-danger btn">Thoát</a> \
			      </div></form></div></div></div>';
		$("#main-content").append($text);
		eventClickBtnUploadGV();
	});
}
//hàm xử lý sự kiện upload file excel
function eventClickBtnUploadGV(){
	$('#btn-upload-GV').click(function(){
		$extention = $('#file-upload-GV').val().split('.').pop();
		if($extention == ""){
			alert("Bạn chưa chọn bất kỳ file nào!!!");
		}
		else if($extention == 'xlsx' || $extention == 'xls'){
			$('#form-upload-GV').submit();
		}
		else{
			alert("Xin lỗi, định dạng file không đúng, làm ơn hãy chọn 1 file .xls hoặc .xlsx");
		}
	});
}
// hàm chuyển chế độ sang thêm giáo viên bằng tay
function eventOpenAddGV(){
	$('#open-add-gv').click(function(){
		//console.log(bomon.length);
		$("#main-content").empty();
		$html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				<br><div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Khởi tạo tài khoản giảng viên bằng file excel.</h3>\
            </div>\
				<form class="form-horizontal">\
				 <div class="box-body">\
                	<div class="form-group">\
				      <label class="col-sm-2 control-label">Mã giảng viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="ip_ma_giang_vien" type="text" placeholder="Mã giảng viên">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên giảng viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="ip_ten_giang_vien" type="text" placeholder="Tên giảng viên">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Email</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="ip_email_gv" type="email" placeholder="Email">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Bộ môn</label>\
				      <div class="col-sm-8">\
				        <select class="form-control" id="ip_bomon">';
				    for(var i=0 ; i < bomon.length ; i++){
				    	$html += '<option value='+bomon[i].id+">"+bomon[i].ten_bo_mon+"</option>";
				    }
					$html +='</select>\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label"></label>\
				      <div class="col-sm-8">\
				        <a id="luuGV" class="btn btn-info btn-lrg ajax">Lưu</a>\
				       <a href="/" class="btn-danger btn">Thoát</a>\
				      </div>\
				    </div>\
             </div> </form></div></div>';
        $("#main-content").append($html);
        luuGV();
	});
}
//hàm lấy list giáo viên vào show ra 
function eventGetListGV(){
	$('#open-ds-gv').click(function(){
		$.get('getListGV',function(data, status){
			if(status == 'success'){
				 $object = JSON.parse(data);
				 //console.log($object);
				 $html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				  <section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box">\
            <div class="box-header">\
              <h2 class="box-title">Danh sách giảng viên trong khoa</h2>\
            </div>\
            <div class="box-body">\
              <table id="example1" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>Mã giảng viên</th>\
                  <th>Tên giảng viên</th>\
                  <th>Thư điện tử</th>\
                  <th>Tên bộ môn</th>\
                </tr>\
                </thead>\
                <tbody>';
				for($i = 0 ; $i < $object.length ; $i++){
					$html += ' <tr>\
					        <td>'+$object[$i].ma_giang_vien+'</td>\
					        <td>'+$object[$i].name+'</td>\
					        <td>'+$object[$i].email+'</td>\
					        <td>'+$object[$i].ten_bo_mon+'</td>\
					      </tr>';
				}
				$html += "</tbody></table></div></div></section>";
				$("#main-content").empty();
				$("#main-content").append($html);
				$("#example1").DataTable();
			}
		});
	});
}

//hàm lấy tất cả bộ môn của 1 khoa về
function getListBomon(){
	 $.get('getListBomon',function(data, status){
		if(status == 'success'){
			//handledate(data);
			bomon = JSON.parse(data);
		}
	});
}
function handledate(data){
	bomon = JSON.parse(data);
	//console.log(bomon);
}

//Hàm xử lý sự kiện khi bấm lưu giáo viên
function luuGV(){
	$('#luuGV').click(function(){
		$ma_giang_vien = $('#ip_ma_giang_vien').val();
		$ten_giang_vien = $('#ip_ten_giang_vien').val();
		$email = $('#ip_email_gv').val();
		$bomon = $('#ip_bomon').val();
		if($ma_giang_vien == ""){
			$('#ip_ma_giang_vien').focus();
		}
		else if($ten_giang_vien == ""){
			$('#ip_ten_giang_vien').focus();
		}
		else if(!validateEmail($email)){
			$email = $('#ip_email_gv').focus();
		}
		else{

			$.get('addGV/'+$ma_giang_vien+"/"+
				$ten_giang_vien+"/"+$email+"/"+$bomon,function(data, status){
				if(status == 'success'){
					console.log(data);
					if(data == 'true'){

						$html = '<div id="alertok" class="alert alert-success" style="position:fixed;bottom:10px;right:10px;">\
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
								  <strong>Thành công!</strong> Đã thêm 1 giảng viên vào CSDL\
								</div>\
								';
						$('#alertok').remove();
						$('#main-content').append($html);
						$('#alertok').delay(5000).fadeOut('fast');
					}
					else{
						$html = '<div id="alertfail" class="alert alert-danger" style="position:fixed;bottom:10px;right:10px;">\
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
								  <strong>Thất bại!</strong> Đã có lỗi xảy ra,vui lòng kiểm tra lại thông tin\
								</div>\
								';
						$('#alertfail').remove();
						$('#main-content').append($html);
						$('#alertfail').delay(5000).fadeOut('fast');
					}
				}
			});

		}

	});
}