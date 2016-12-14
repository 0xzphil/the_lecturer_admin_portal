/*
* @file: eventAtKhCtdt.js
* @author: Nguyễn Minh Hiếu
* @Chức năng: Xử lý sự kiện khi người dùng thao tác trên tree Khóa học và chương trình đào tạo
*/


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
              <button class="btn btn-primary col-sm-2" data-toggle="modal" data-target="#modal1">Thêm khóa học</button>\
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
              <button class="btn btn-primary col-sm-2" data-toggle="modal" data-target="#modal2">Thêm chương trình đào tạo</button>\
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

// xử lý sự kiện khi bấm lưu 1 khóa học
function saveKhoahoc(){
  $('#saveKhoahoc').click(function(){
      $khoa_hoc = $('#ip_tenkhoahoc').val();
      if($khoa_hoc == ""){
        $('#ip_tenkhoahoc').focus();
      }
      else{
        $('#modal1').modal('toggle');
        $.get('addKhoahoc/'+$khoa_hoc,function(data, status){
          if(status == 'success'){
            //alert(data);
            
            if(data == "true"){
              createAlert('success',"Thành công! Đã thêm 1 khóa học vào database.");
            }
            else{
              createAlert('danger',"Thất bại! Vui lòng kiểm tra lại thông tin.");
            }
          }
        });
      }
  });
}

// xử lý sự kiện khi bấm lưu 1 chương trình đào tạo

function saveCtdt(){
  $('#saveCtdt').click(function(){
    $ctdt = $('#ip_tenctdt').val();
    if($ctdt ==""){
      $('#ip_tenctdt').focus();
    }
    else{
      $('#modal2').modal('toggle');
      $.get('addCtdt/'+$ctdt,function(data,status){
        if(status == 'success'){
           if(data == "true"){
              createAlert('success',"Thành công! Đã thêm 1 CTDT vào database.");
            }
            else{
              createAlert('danger',"Thất bại! Vui lòng kiểm tra lại thông tin.");
            }
        }
      });
    }
  });

}