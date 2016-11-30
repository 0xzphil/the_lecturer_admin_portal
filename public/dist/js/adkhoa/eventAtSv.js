//mở form upload tài khoản sin viên bằng excel
function eventOpenUploadSv(){
	var token = $('meta[name="csrf_token"]').attr('content');
	//console.log(token);
	$('#open-upload-sv').click(function(){
		$("#main-content").empty();
		$text = '<br><div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
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
			       	alert(data);
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
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="ip_ten_sinh_vien" type="text" placeholder="Tên sinh viên">\
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
	});
}