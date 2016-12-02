//mở form upload tài khoản sin viên bằng excel
function eventOpenUploadSv(){
	var token = $('meta[name="csrf_token"]').attr('content');
	//console.log(token);
	$('#open-upload-sv').click(function(){
		$("#main-content").empty();
		$text = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
			<br><div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Khởi tạo tài khoản sinh viên bằng file excel.</h3>\
            </div>\
			      <form class="form-horizontal" name="form-upload-SV" action="#" method="post" enctype="multipart/form-data">\
			         <div class="box-body">\
			            <input id="file-upload-SV"  type="file" name="exSV" id="exSV" />\
			            <br>\
			            <input id = "btn-upload-SV" class="btn btn-info" type="button" value="Upload">'
			            + '<input type="hidden" name="_token" value="'+token+'" /> '+             
			      '<a href="/" class="btn-danger btn">Thoát</a> \
			      </div></form></div></div></div>';
		$("#main-content").append($text);
		eventClickBtnUploadSV();
	});
}

//hàm xử lý sự kiện upload file excel SV
function eventClickBtnUploadSV(){
	$('#btn-upload-SV').click(function(){
		$extention = $('#file-upload-SV').val().split('.').pop();
		if($extention == ""){
			alert("Bạn chưa chọn bất kỳ file nào!!!");
		}
		else if($extention == 'xlsx' || $extention == 'xls'){
			var form = document.forms.namedItem("form-upload-SV"); // high importance!, here you need change "yourformname" with the name of your form
			var formdata = new FormData(form); 
			$.ajax({
				  async: true,
			      type:'POST',
			      dataType:'html',
			      contentType: false,
			      url:'uploadSV',
			      data: formdata,
			      processData: false, 
			      success:function(data){
			      	 console.log(data);
			       	 $result = JSON.parse(data);

			       	 console.log($result.done);
			       	 $html = '<div id="alertok" class="alert alert-success" style="position:fixed;bottom:10px;right:10px;">\
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
								  <strong>Thông báo!</strong> Đã thêm thành công:'+$result.done+', thất bại:'+$result.fail+' \
								</div>\
								';
						$('#alertok').remove();
						$('#main-content').append($html);
						$('#alertok').delay(5000).fadeOut('fast');
			      }
			});
		}
		else{
			alert("Xin lỗi, định dạng file không đúng, làm ơn hãy chọn 1 file .xls hoặc .xlsx");
		}
	});
}

// hàm chuyển chế độ sang thêm giáo viên bằng tay
function eventOpenAddSV(){
	$('#open-add-sv').click(function(){
		//console.log(bomon.length);
		$("#main-content").empty();
		$html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				<br><div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Khởi tạo tài khoản sinh viên bằng file excel.</h3>\
            </div>\
				<form class="form-horizontal">\
				 <div class="box-body">\
                	<div class="form-group">\
				      <label class="col-sm-2 control-label">Mã sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="ip_ma_sinh_vien" type="text" placeholder="Mã sinh viên">\
				      </div>\
				      <span class="col-sm-2 help-block" style="display:none;color:#dd4b39">Mã sinh viên gồm 8 số</span>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="ip_ten_sinh_vien" type="text" placeholder="Tên sinh viên">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Khóa học</label>\
				      <div class="col-sm-8">\
				        <select class="form-control" id="ip_khoahoc">';
				    for(var i=0 ; i < khoa_hoc.length ; i++){
				    	$html += '<option value='+khoa_hoc[i].id+">"+khoa_hoc[i].mo_ta+"</option>";
				    }
					$html +='</select>\
				      </div>\
				    </div>';
				    $html += '<div class="form-group">\
				      <label class="col-sm-2 control-label">Chương trình đào tạo</label>\
				      <div class="col-sm-8">\
				        <select class="form-control" id="ip_ctdt">';
				        for(var i=0 ; i < ctdt.length ; i++){
				    	$html += '<option value='+ctdt[i].id+">"+ctdt[i].mo_ta+"</option>";
				    }
					$html +='</select>\
				      </div>\
				    </div>';

				    $html += '<div class="form-group">\
				      <label class="col-sm-2 control-label"></label>\
				      <div class="col-sm-8">\
				        <a id="luuSV" class="btn btn-info btn-lrg ajax">Lưu</a>\
				       <a href="/" class="btn-danger btn">Thoát</a>\
				      </div>\
				    </div>\
             </div> </form></div></div>';
        $("#main-content").append($html);
        saveSV();
	});
}

//Hàm xử lý lưu sinh viên ở chế độ thêm thủ công sinh viên 
function saveSV(){
	$('#luuSV').click(function(){
		$ma_sinh_vien = $('#ip_ma_sinh_vien').val();
		$ten_sinh_vien = $('#ip_ten_sinh_vien').val();
		$khoa_hoc = $('#ip_khoahoc').val();
		$ctdt = $('#ip_ctdt').val();
		if($ma_sinh_vien == '' || $ma_sinh_vien.length != 8){
			$('#ip_ma_sinh_vien').focus();
			$('.help-block').css('display','block');
		}

		else if($ten_sinh_vien == ''){
			$('#ip_ten_sinh_vien').focus();
		}
		else{
			$.get('addSV/'+$ma_sinh_vien+"/"+$ten_sinh_vien+"/"+$khoa_hoc+"/"+$ctdt,
				function(data , status){
					if(status == "success"){
						if(data == "true"){
							$html = '<div id="alertok" class="alert alert-success" style="position:fixed;bottom:10px;right:10px;">\
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
								  <strong>Thành công!</strong> Đã thêm 1 sinh viên vào CSDL\
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

function getListSV(){
	$('#open-ds-sv').click(function(){
		$.get('getListSV',function(data, status){
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
              <h2 class="box-title">Danh sách sinh viên trong khoa</h2>\
            </div>\
            <div class="box-body">\
              <table id="example1" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>Mã sinh viên</th>\
                  <th>Tên sinh viên viên</th>\
                  <th>Thư điện tử</th>\
                  <th>Khóa học</th>\
                  <th>Chương trình đào tạo</th>\
                  <th>Trạng thái</th>\
                </tr>\
                </thead>\
                <tbody>';
				for($i = 0 ; $i < $object.length ; $i++){
					var tt;
					if($object[$i].dang_ky == 1){
						tt = "Được đăng ký";
					}
					else{
						tt = "Chưa được đăng ký";
					}
					$html += ' <tr>\
					        <td>'+$object[$i].ma_sinh_vien +'</td>\
					        <td>'+$object[$i].ten_sinh_vien+'</td>\
					        <td>'+$object[$i].ma_sinh_vien+"@vnu.edu.vn"+'</td>\
					        <td>'+$object[$i].khoa_hoc+'</td>\
					        <td>'+$object[$i].ctdt+'</td>\
					        <td>'+tt+'</td>\
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