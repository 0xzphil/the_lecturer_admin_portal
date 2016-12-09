function getListDetaiBaove(){
	$('#dsdtbv').click(function(){
		$.get('getListDetaiBaove',function(data, status){
			$object = JSON.parse(data);
			console.log($object);

			$html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				  <section class="content"><div class="row">\
        					<div class="col-xs-12">\
        					<div class="box box-primary">\
            <div class="box-header with-border">\
              <h2 class="box-title col-lg-10">Danh sách đăng ký bảo vệ trong khoa</h2>\
              <button data-toggle="modal" data-target="#modal6" class = "btn btn-primary col-lg-2">Gửi nhắc nhở</button>\
              </div>\
            <div class="box-body">\
              <table id="tb-dtbv" class="table table-bordered table-striped table-hover">\
                <thead>\
                <tr>\
                  <th>STT</th>\
                  <th>Mã sinh viên</th>\
                  <th>Tên sinh viên</th>\
                  <th>Tên đề tài</th>\
                  <th>Nộp hồ sơ</th>\
                  <th>Hợp thức hồ sơ</th>\
                  <th>Hoàn tất hồ sơ</th>\
                </tr>\
                </thead>\
                <tbody>';
				for($i = 0 ; $i < $object.length ; $i++){
					$html += ' <tr class="row-dtbv">\
					        <td>'+($i+1)+'</td>\
					        <td>'+$object[$i].ma_sinh_vien+'</td>\
					        <td>'+$object[$i].ten_sinh_vien+'</td>\
					        <td>'+$object[$i].ten_de_tai+'</td>';
					if($object[$i].ho_so == 1){
						$html += '<td><input type="checkbox" checked="checked" disabled/></td>?';
					}
					else{
						$html += '<td><input type="checkbox" disabled/></td>';
					}
					if($object[$i].hop_thuc == 1){
						$html += '<td><input type="checkbox" checked="checked" disabled/></td>?';
					}
					else{
						$html += '<td><input type="checkbox" disabled/></td>';
					}
					if($object[$i].hoan_tat == 1){
						$html += '<td><input type="checkbox" checked="checked" disabled/></td>?';
					}
					else{
						$html += '<td><input type="checkbox" disabled/></td>';
					}
					$html += '</tr>';
				}
				$html += "</tbody></table></div></div></section>";
				$("#main-content").empty();
				$("#main-content").append($html);
				$("#tb-dtbv").DataTable();
				clickRowDkbv();
		});
	});
}

function clickRowDkbv(){
	$('.row-dtbv').click(function(){
		var child  = $(this).children();
		$('#ip_msv_bv').val(child[1].innerHTML);
		$('#ip_tsv_bv').val(child[2].innerHTML);
		$('#ip_tdt_bv').val(child[3].innerHTML);

		if(child[4].children[0].checked == true){
			$('#cb-hs').attr('checked','checked');
		} 
		if(child[5].children[0].checked == true){
			$('#cb-hthuc').attr('checked','checked');
		}
		if(child[6].children[0].checked == true){
			$('#cb-htat').attr('checked','checked');
		}

		$('#modal5').modal('show');
		
	});
}

function saveHoso(){
	$('#saveHoso').click(function(){
		$('#modal5').modal('toggle');
		var ma_sinh_vien = $('#ip_msv_bv').val();
		var ho_so = $('#cb-hs').is(':checked') ? 1 : 0;
		var hop_thuc = $('#cb-hthuc').is(':checked') ? 1 : 0;
		var hoan_tat = $('#cb-htat').is(':checked') ? 1 : 0;
		$.get('saveHoso/'+ma_sinh_vien+"/"+ho_so+"/"+hop_thuc+"/"+hoan_tat , function(data,status){
			if(status == 'success'){
				if(data == 'true'){
					createAlert('success',"Lưu trạng thái hồ sơ thành công!");
				}
				else{
					createAlert('danger',"Đã có lỗi xảy ra vui lòng thử lại sau!");
				}
			}
		});
	});
}

function clickguinhacnho(){
	$('#btnguinhacnho').click(function(){
		$('#modal6').modal('toggle');
		$.get('guinhacnho',function(data, status){
			if(status =="success"){
				if(data == "true"){
					createAlert('success','Gửi nhắc nhở thành công!')
				}
				else{
					createAlert('danger','Gửi nhắc nhở không thành công!')
				}
			}
		});
	});
}
