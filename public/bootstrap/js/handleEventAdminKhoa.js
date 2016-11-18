$(document).ready(function(){
		eventOpenUploadGv();
		eventOpenAddGV();
		eventGetListGV()
});
function eventOpenUploadGv(){
	$_token = $("#_token").val();
	$('#open-upload-gv').click(function(){
		$("#main-content").empty();
		$text = '<div class="col-sm-2"></div>\
				<div class="col-sm-10">\
				<h2>Form tải lên file tài khoản giảng viên, hãy tải lên 1 file excel</h2></div>\
			      <form class="form-horizontal" id="form-upload-GV" action="/uploadGV" method="post" enctype="multipart/form-data">\
			         <label class="col-sm-2 control-label"></label>\
			         <div class="col-sm-8">\
			            <input id="file-upload-GV"  type="file" name="image" id="image" />\
			            <br>\
			            <input id = "btn-upload-GV" class="btn btn-info" type="button" value="Upload">'
			            + '<input type="hidden" name="_token" value="'+$_token+'" /> '+             
			      '<a href="/" class="btn-danger btn">Thoát</a> \
			      </div></form>';
		$("#main-content").append($text);
		eventClickBtnUploadGV();
	});
}
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
function eventOpenAddGV(){
	$('#open-add-gv').click(function(){
		$("#main-content").empty();
		$html = '<div class="col-sm-2"></div>\
				<div class="col-sm-10">\
				<h2>Form thêm tay giảng viên</h2></div>\
				<form class="form-horizontal" action="#" method="post">\
                	<div class="form-group">\
				      <label class="col-sm-2 control-label">Mã giảng viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="" type="text" placeholder="Mã giảng viên">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên giảng viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="" type="text" placeholder="Tên giảng viên">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Email</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="" type="email" placeholder="Email">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Đơn vị</label>\
				      <div class="col-sm-8">\
				        <select class="form-control" id="sel1">\
						    <option>1</option>\
						    <option>2</option>\
						    <option>3</option>\
						    <option>4</option>\
						  </select>\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label"></label>\
				      <div class="col-sm-8">\
				        <button class="btn btn-info">Lưu</button>\
				       <a href="/" class="btn-danger btn">Thoát</a>\
				      </div>\
				    </div>\
              </form>';
        $("#main-content").append($html);
	});
}
function eventGetListGV(){
	$('#open-ds-gv').click(function(){
		$.get('/getListGV',function(data, status){
			if(status == 'success'){
				 $object = JSON.parse(data);
				 console.log($object);
				 $html = '<h2>Danh sách giảng viên trong khoa</h2>\
				 		<table class="table table-striped">\
						    <thead>\
						      <tr>\
						        <th>Mã giảng viên</th>\
						        <th>Họ và tên</th>\
						        <th>Email</th>\
						        <th>Bộ môn</th>\
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
				$html += "</tbody></table>";
				$("#main-content").empty();
				$("#main-content").append($html);
			}
		});
	});
}