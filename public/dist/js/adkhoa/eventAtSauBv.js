/*Hàm lấy danh sách sau bảo vệ*/
function getListSauBv(){
	$('#dssbv').click(function(){
		$.get('getListSauBv',function(data,status){
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
	              <h2 class="box-title col-lg-10">Danh sách đề tài đã bảo vệ</h2>\
	              </div>\
	            <div class="box-body">\
	              <table id="tb-sbv" class="table table-bordered table-striped table-hover">\
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
						        <td>'+$object[$i].ten_de_tai+'</td>';
						  $html +=    '</tr>';
						    
					}
					$html += "</tbody></table></div></div></section>";
					$("#main-content").empty();
					$("#main-content").append($html);
					$("#tb-sbv").DataTable();
			}
		});	
	});

}