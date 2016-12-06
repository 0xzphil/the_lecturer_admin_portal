
//xử lý sự kiện khi nhân viên khoa khởi tạo các tài khoản được đăng ký từ excel
function openKhoitao(){
	$('#open-khoitao').click(function(){
		var token = $('meta[name="csrf_token"]').attr('content');
		$("#main-content").empty();
		$text = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
			<br><div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Khởi tạo danh sách sinh viên được đăng ký bằng file excel.</h3>\
            </div>\
			      <form class="form-horizontal" name="form-upload-kt" action="#" method="post" enctype="multipart/form-data">\
			         <div class="box-body">\
			            <input id="file-upload-khoitao"  type="file" name="exKt" id="exKt" />\
			            <br>\
			            <input id = "btn-upload-khoitao" class="btn btn-info" type="button" value="Upload">'+
			            '<input type="hidden" name="_token" value="'+token+'" /> '+  
			      '<a href="/" class="btn-danger btn">Thoát</a> \
			      </div></form></div></div></div>';
		$("#main-content").append($text);
		eventClickBtnUploadKt();
	});
}

//hàm upload sinh viên được đăng ký đề tài bằng excel
function eventClickBtnUploadKt(){
	$('#btn-upload-khoitao').click(function(){
		$extention = $('#file-upload-khoitao').val().split('.').pop();
		if($extention == ""){
			alert("Bạn chưa chọn bất kỳ file nào!!!");
		}
		else if($extention == 'xlsx' || $extention == 'xls'){
			var form = document.forms.namedItem("form-upload-kt"); // high importance!, here you need change "yourformname" with the name of your form
			var formdata = new FormData(form); 
			$.ajax({
				  async: true,
			      type:'POST',
			      dataType:'html',
			      contentType: false,
			      url:'uploadKt',
			      data: formdata,
			      processData: false, 
			      success:function(data){
			      	 //console.log(data);
			       	 $result = JSON.parse(data);

			       	 //console.log($result.done);
			       	 createAlert('success', 'Thông báo! Đã thay đổi trạng thái thành công:'+$result.done+', thất bại:'+$result.fail);
			      }
			});
		}
		else{
			alert("Xin lỗi, định dạng file không đúng, làm ơn hãy chọn 1 file .xls hoặc .xlsx");
		}
	});
}

function openSVDDK(){
	$('#open-svddk').click(function(){
		$.get('getListSV',function(data, status){
			if(status == 'success'){
				$object = JSON.parse(data);
				 //console.log($object[0]);
				 $html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				 <section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box">\
            <div class="box-header">\
              <h2 class="box-title col-lg-9">Danh sách sinh viên trong khoa</h2>\
              <button class="btn btn-primary col-lg-3" data-toggle="modal" data-target="#modal3">Thêm sinh viên vào danh sách</button>\
            </div>\
            <div class="box-body">\
              <table id="tb-svdk" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>STT</th>\
                  <th>Mã sinh viên</th>\
                  <th>Tên sinh viên</th>\
                </tr>\
                </thead>\
                <tbody>';
                var stt = 1;
				for($i = 0 ; $i < $object.length ; $i++){
					if($object[$i].dang_ky == 1){
						$html += ' <tr>\
					        <td>'+stt+'</td>\
					        <td>'+$object[$i].ma_sinh_vien+'</td>\
					        <td>'+$object[$i].ten_sinh_vien+'</td>\
					      </tr>';
					     stt++;
					}
				}
				$html += "</tbody></table></div></div></section>";
				$("#main-content").empty();
				$("#main-content").append($html);
				$("#tb-svdk").DataTable();
			}
		});
	});
}

/*
 * hàm xử lý sự kiện lưu 1 sinh viên vào danh sách được đăng ký
*/
function addSVDDK(){
	$('#save-sv-ddk').click(function(){
		var msv = $('#ip_msv_ddk').val();
		//console.log(msv);
		if(validateMSV(msv)){
			 $('#modal3').modal('toggle');
			$.get('addSVDDK/'+msv,function(data,status){
				if(status == "success"){
					if(data == "true"){
						createAlert('success',"Thành công! Đã thêm 1 sinh viên vào danh sách được đăng ký.")
					}
					else{
						createAlert('danger','Thất bại! Kiểm tra lại mã sinh viên đã nhập.')
					}
				}
			});
		}
		else{
			$('#wsvddk').css('display','block');
			$('#ip_msv_ddk').focus();
		}
	});
}