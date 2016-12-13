/*
* @file: eventAtCv.js
* @author: Nguyễn Minh Hiếu
* @Chức năng: Xử lý sự kiện khi người dùng thao tác trên tree Công văn
*/

function getListCv(){
	$('#cv').click(function(){
		$.get('getListCv',function(data,status){
			if(status == 'success'){
				//console.log(data);
				$html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				  <section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box box-primary">\
            <div class="box-header with-border">\
              <h2 class="box-title col-lg-10">Danh sách giảng viên trong khoa</h2>\
              </div>\
            <div class="box-body">\
              <table id="tb-cv" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>STT</th>\
                  <th>Mô tả</th>\
                  <th>Công văn</th>\
                  <th>Danh sách đính kèm</th>\
                </tr>\
                </thead>\
                <tbody>';
				for($i = 0 ; $i < data.length ; $i++){
					$html += ' <tr class="row-dtbv">\
					        <td>'+($i+1)+'</td>\
					        <td>'+data[$i].mo_ta+'</td>\
					        <td><a href="downloadFile/'+data[$i].pathfile+'" class="link-file">'+data[$i].pathfile+'</a></td>\
					        <td><a href="downloadFile/'+data[$i].pathattachfile+'" class="link-file">'+data[$i].pathattachfile+'</a></td>\
					      </tr>';
				}
				$html += "</tbody></table></div></div></section>";
				$("#main-content").empty();
				$("#main-content").append($html);
				$("#tb-cv").DataTable();
			}
		});	
	});
}