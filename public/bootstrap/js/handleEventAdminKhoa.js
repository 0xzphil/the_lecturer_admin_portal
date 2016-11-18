var bomon ;
$(document).ready(function(){
		
		eventOpenUploadGv();
		eventOpenAddGV();
		eventGetListGV();
	    getListBomon();
	    //console.log(window.bomon);
});
//hàm chuyển chế độ sang chế độ upload file excel
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
		$html = '<div class="col-sm-2"></div>\
				<div class="col-sm-10">\
				<h2>Form thêm tay giảng viên</h2></div>\
				<form class="form-horizontal">\
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
				        <a id="luuGV" class="btn btn-info">Lưu</a>\
				       <a href="/" class="btn-danger btn">Thoát</a>\
				      </div>\
				    </div>\
              </form>';
        $("#main-content").append($html);
        luuGV();
	});
}
//hàm lấy list giáo viên vào show ra 
function eventGetListGV(){
	$('#open-ds-gv').click(function(){
		$.get('/getListGV',function(data, status){
			if(status == 'success'){
				 $object = JSON.parse(data);
				 //console.log($object);
				 $html = '<h2 style="margin:0px;">Danh sách giảng viên trong khoa</h2>\
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

//hàm lấy tất cả bộ môn của 1 khoa về
function getListBomon(){
	 $.get('/getListBomon',function(data, status){
		if(status == 'success'){
			handledate(data);
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
			$.get('/addGV/'+$ma_giang_vien+"/"+
				$ten_giang_vien+"/"+$email+"/"+$bomon,function(data, status){
				if(status == 'success'){
					console.log(data);
					if(data == 'true'){

						$html = '<div id="alertok" class="alert alert-success" style="position:fixed;bottom:10px;right:10px;">\
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
								  <strong>Thành công!</strong> Đã thêm 1 giảng viên vào CSDL\
								</div>\
								';
						$('#main-content').append($html);
					}
					else{
						$html = '<div class="alert alert-danger" style="position:fixed;bottom:10px;right:10px;">\
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
								  <strong>Thất bại!</strong> Đã có lỗi xảy ra,vui lòng kiểm tra lại thông tin\
								</div>\
								';
						$('#main-content').append($html);
					}
				}
			});
		}

	});
}

//Hàm validate email
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}