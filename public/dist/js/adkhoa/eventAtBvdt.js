
/*Hàm click vào danh sách bảo vệ*/
var detaibaove1;
function clickDsbv(){
	$('#dsbvdt1').click(function(){
		$.get('getDsbv',function(data,status){
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
	              <h2 class="box-title col-lg-10">Danh sách đề tài được bảo vệ</h2>\
	              </div>\
	            <div class="box-body">\
	              <table id="tb-bv" class="table table-bordered table-striped table-hover">\
	                <thead>\
	                <tr>\
	                  <th>STT</th>\
	                  <th>Mã sinh viên</th>\
	                  <th>Tên sinh viên</th>\
	                  <th>Đề tài</th>\
	                  <th>Chốt phản biện</th>\
	                </tr>\
	                </thead>\
	                <tbody>';
					for($i = 0 ; $i < $object.length ; $i++){
						$html += ' <tr class="row-bv1">\
						        <td>'+($i+1)+'</td>\
						        <td>'+$object[$i].ma_sinh_vien+'</td>\
						        <td>'+$object[$i].ten_sinh_vien+'</td>\
						        <td>'+$object[$i].ten_de_tai+'</td>';
						    if($object[$i].chot_phan_bien == 1){
						    	$html+= '<td>Xong</td>';
						    }else{
						    	$html+= '<td>Chưa xong</td>';
						    }
						       	
						  $html +=    '</tr>';
						    
					}
					$html += "</tbody></table></div></div></section>";
					$("#main-content").empty();
					$("#main-content").append($html);
					$("#tb-bv").DataTable();
					clickRowBv1();
			}
		});
	});
}
/*Xử lý click row sự kiện trên Danh sách bảo vệ*/
function clickRowBv1(){
	$('.row-bv1').click(function(){
		var child  = $(this).children();
		var ma_sinh_vien = child[1].innerHTML;
		
		for($i = 0 ; $i < detaibaove1.length ; $i++){
			if(ma_sinh_vien == detaibaove1[$i].ma_sinh_vien){
				sinh_vien = detaibaove1[$i];
				break;
			}
		}
		$('#main-content').empty();
			$html = '<h3 style="margin-left:10px;">Thông tin đề tài và phản biện</h3>\
				<div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title col-lg-10">Thông tin sinh viên và đề tài</h3>\
            </div>\
				<form class="form-horizontal">\
				 <div class="box-body">\
                	<div class="form-group">\
				      <label class="col-sm-2 control-label">Mã sinh viên</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="pcmsv1" type="text" value="'+ma_sinh_vien+'" disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên sinh viên</label>\
				      <div class="col-sm-8">\
				        <input id="pbtsv" class="form-control" type="text" value="'+sinh_vien.ten_sinh_vien+'"  disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Giảng viên hướng dẫn</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" type="text" value="'+sinh_vien.ten_gv+'"  disabled="disabled">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Tên đề tài</label>\
				      <div class="col-sm-8">\
				        <textarea id="pbtdt" class="form-control" rows="2" disabled="disabled">'+sinh_vien.ten_de_tai+'</textarea>\
				      </div>\
				    </div>\
             </div> </form></div></div>';
             console.log(sinh_vien)
        	$html += '<section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box box-primary">\
            <div class="box-header with-border">\
              <h2 class="box-title col-lg-10">Phần phản biện</h2>';
                if(sinh_vien.chot_phan_bien == 0){
                	$html += '<button id="btnchotphanbien" class="btn btn-primary col-lg-2">Chốt phản biện</button>';
                }
             $html += '</div>\
            <div class="box-body">\
              <table id="tb-pc" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>STT</th>\
                  <th>Tên giảng viên</th>\
                  <th>Đánh giá</th>\
                  <th>Điểm</th>\
                </tr>\
                </thead>\
                <tbody id="bodypc">';
				for($i = 0 ; $i < sinh_vien.listDanhgia.length ; $i++){
					$html += ' <tr class="row-pc"><input type="hidden" value="'+sinh_vien.listDanhgia[$i].id+'">\
					        <td>'+($i+1)+'</td>\
					        <td>'+sinh_vien.listDanhgia[$i].ten_gvdg+'</td>'+
					        '<td>'+(sinh_vien.listDanhgia[$i].danh_gia != "" ? sinh_vien.listDanhgia[$i].danh_gia : "Chưa có")+'</td>'+
					        '<td>'+(sinh_vien.listDanhgia[$i].diem) +'</td>'+
					        '</tr>';
				}
				$html += "</tbody></table></div></div></section>";
	        $("#main-content").append($html);
			$('#tb-pc').DataTable();
			clickRowPC();
			clickChotphanbien();
	});
}
/*Xử lý sự kiện click vào 1 dòng trong điền phản biện và điểm cho đề tài */
function clickRowPC(){
	$('.row-pc').click(function(){
		$('#pb-ten-de-tai').val($('#pbtdt').val());

		var child  = $(this).children();
		$('#pb-ten-gv').val(child[2].innerHTML);
		$('#ip_dgpb').val((child[3].innerHTML));
		$('#pb-diem-de-tai').val(child[4].innerHTML);
		$('#iddg').val(child[0].value);
		//console.log(child[0].value);

		$('#modal10').modal('show');
	});
}
/*Xử lý sự kiện khi bấm lưu đánh giá và điểm ở modal 10*/
function saveDgDiem(){
	$('#btnluupc').click(function(){
		$id = $('#iddg').val();
		$danh_gia = $('#ip_dgpb').val();
		$diem = $('#pb-diem-de-tai').val();
		if(($danh_gia == "Chưa có" || $danh_gia == "") && $diem == 0 || $diem == "" ){
			alert("Bạn chưa thay đổi gì!");
		}
		else if (isNaN($diem)){
			alert("Điểm không hợp lệ.");
		}
		else{
			$('#modal10').modal('toggle');
			$.get('saveDgDiem/'+$id+"/"+$danh_gia+"/"+$diem,function(data,status){
				if(status == 'success'){
					if(data == "true"){
						createAlert('success',"Lưu thành công đánh giá và điểm!");
					}
					else{
						createAlert('danger',"Đã có lỗi xảy ra! Thử lại sau.")
					}
				}
			});
		}
	});
}
/* Hàm gọi chốt phản biện và xuất biên bản bảo vệ*/
function clickChotphanbien(){
	$('#btnchotphanbien').click(function(){
		$('#modal11').modal('show');
	});
}
clickChotphanbien1();
function clickChotphanbien1(){
	$('#btnchotphanbien1').click(function(){
		$('#modal11').modal('toggle');
		$ma_sinh_vien = $('#pcmsv1').val();
		$.get('chotphanbien/'+$ma_sinh_vien,function(data,status){
			if (status == "success") {
				if (data == "true") {
					createAlert('success',"Đã chốt phản biện và xuất biên bản!");
					$('#btnchotphanbien').remove();
				}
				else if(data == "false"){
					createAlert('danger',"Chưa hoàn thành tất cả đánh giá và điểm");
				}
			}
		});
	});
}

/*Hàm xử lý xuất công văn và danh sách điểm*/
function clickXuatdsdiem(){
	$('#dsdiem').click(function(){
		$.get('xuatDsdiem',function(data,status){
			if(status == "success"){
				console.log(data);
				if(data == "true"){
					createAlert('success',"Đã xuất công văn và danh sách điểm thành công!");
				}
				 else if(data == "false"){
				 	createAlert('danger',"Tồn tại 1 đề tài chưa chốt phản biện");
				}
				else {
					createAlert('danger',"Có lỗi xảy ra, thử lại sau!");
				}
			}
		});
	});

}