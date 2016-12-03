
//mở ra bảng danh sách các khóa học
function openKhoahoc(){
	$('#open-khoahoc').click(function(){
		$html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				 <section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box">\
            <div class="box-header">\
              <h2 class="box-title col-sm-10">Danh sách khóa học</h2>\
              <button class="btn btn-primary col-sm-2">Thêm khóa học</button>\
            </div>\
            <div class="box-body">\
              <table id="example1" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>Số thứ tự</th>\
                  <th>Khóa học</th>\
                </tr>\
                </thead>\
                <tbody>';
				for($i = 0 ; $i < khoa_hoc.length ; $i++){
						$html+= '<tr><td>'+($i+1)+
								'</td><td>'+khoa_hoc[$i].mo_ta+
						'</td></tr>'
				}
				$html += "</tbody></table></div></div></section>";
				$("#main-content").empty();
				$("#main-content").append($html);
				$("#example1").DataTable();
	});
}

//mở ra bảng danh sách các Chương trình đào tạo

function openCtdt(){
		$('#open-ctdt').click(function(){
		$html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				 <section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box">\
            <div class="box-header">\
              <h2 class="box-title col-sm-10">Danh sách khóa học</h2>\
              <button class="btn btn-primary col-sm-2">Thêm chương trình đào tạo</button>\
            </div>\
            <div class="box-body">\
              <table id="example3" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>Số thứ tự</th>\
                  <th>Chương trình đào tạo</th>\
                </tr>\
                </thead>\
                <tbody>';
				for($i = 0 ; $i < ctdt.length ; $i++){
						$html+= '<tr><td>'+($i+1)+
								'</td><td>'+ctdt[$i].mo_ta+
						'</td></tr>'
				}
				$html += "</tbody></table></div></div></section>";
				$("#main-content").empty();
				$("#main-content").append($html);
				$("#example3").DataTable();
	});
}