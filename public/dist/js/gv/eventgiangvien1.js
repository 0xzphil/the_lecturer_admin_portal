var linhvuc;

function openAddHnc(){
	$('#btn-add-hnc').click(function(){
		//getListLinhVuc();
		$('#main-content').empty();
		$html = '<div id="wait" class="alert alert-success" style="display:none;position:fixed;bottom:10px;right:10px;">\
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>\
                   <i class="fa fa-refresh fa-spin"></i>\
                  <strong>Đang xử lý...</strong>\
                </div>\
				<br><div class=""><div class="col-lg-12 col-md-12 col-sm-12"> <div class="box box-primary">\
            <div class="box-header with-border">\
              <h3 class="box-title">Thêm Hướng nghiên cứu</h3>\
            </div>\
				<form class="form-horizontal">\
				 <div class="box-body">\
                	<div class="form-group">\
				      <label class="col-sm-2 control-label">Chủ đề</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="ip_chu_de" type="text" placeholder="Nhập chủ đề">\
				      </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Mô tả</label>\
				      <div class="col-sm-8">\
				        <input class="form-control" id="ip_mo_ta" type="text" placeholder="Nhập mô tả">\
				      </div>\
				    </div>\
				    </div>\
				    <div class="form-group">\
				      <label class="col-sm-2 control-label">Lĩnh vực liên quan</label>\
				      <div class="col-sm-8">\
				        <select multiple class="form-control" id="ip_linh_vuc_lq" >;'  
				        for(var i = 0; i< linhvuc.length;i++){
				        	$html += "<option value="+linhvuc[i].id+">"+linhvuc[i].ten+"</option>";
				        }
				        $html +='</select>\
				      </div>\
				    </div>\
				    <div class="form-group">\
				    	<div class="col-sm-2"></div>\
				    	<div class="col-sm-8">\
				     	<a id="saveHnc" class="btn btn-info">Lưu</a>\
				     	<a class="btn btn-danger" href="/">Thoát</a></div>\
				    </div>\
             </div> </form></div></div>';
        $("#main-content").append($html);
        saveHnc();
        //luuGV();
	});
}

function saveHnc(){
	$('#saveHnc').click(function(){
		$ten_huong_nc = $('#ip_chu_de').val();
		$mo_ta = $('#ip_mo_ta').val();
		$linh_vuc_lq = $('#ip_linh_vuc_lq').val();
		//console.log($ten_huong_nc,$mo_ta,$linh_vuc_lq);
		if($ten_huong_nc!= null){
			$.get('addHNC/'+$ten_huong_nc+"/"+$mo_ta+"/"+$linh_vuc_lq,
				function(data , status){
						console.log(data)
						if(status == "success"){
							if(data == "true"){
								$html = '<div id="alertok" class="alert alert-success" style="position:fixed;bottom:10px;right:10px;">\
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
									  <strong>Thành công!</strong> Đã thêm dữ liệu vào CSDL\
									</div>\
									';
								$('#alertok').remove();
								$('#main-content').append($html);
								$('#alertok').delay(5000).fadeOut('fast');
							}
							else{
								$html = '<div id="alertfail" class="alert alert-danger" style="position:fixed;bottom:10px;right:10px;">\
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
									  <strong>Thất bại!</strong> Đã có lỗi xảy ra,vui lòng kiểm tra lại thông tin\
									</div>\
									';
								$('#alertfail').remove();
								$('#main-content').append($html);
								$('#alertfail').delay(5000).fadeOut('fast');
							}
						}
					});
		}
	});
}
function getListLinhVuc(){
	$.get('listLvcb',function(data,status){
		if(status == 'success'){
			//console.log(data);
			//linhvuc = JSON.parse(data);
			linhvuc = data;
			//console.log(linhvuc);
		}
	});
}

// function getOneHnc(){
// 	$id=$('#id-sua-hidden').val();
// 	$.get('getOneHnc/'+$id,function(data,status){
// 		if(status == 'success'){
// 			//console.log(data);
// 			//linhvuc = JSON.parse(data);
// 			Alinhvuc = JSON.parse(data);
// 			console.log(Alinhvuc);
// 	});
// }

function openSuaHnc(){
	//getListLinhVuc();
	$('.btn-sua-hnc').click(function(){
		$('#sua-Modal').modal('show');
		$id=$(this).siblings(':hidden').val();
		$('#id-sua-hidden').val($id);
		$('#ip_sua_linh_vuc_lq').empty();
		$(this).parent().siblings('div').attr('id',$id);
		//getOneHnc();
		for (var i = 0; i < linhvuc.length; i++) {
			$('#ip_sua_linh_vuc_lq').append($('<option>',{
				value:linhvuc[i].id,
				text:linhvuc[i].ten
			}));
		};
	});
	saveSuaHnc();
}

function saveSuaHnc(){
	$('#btn-cap-nhat').click(function(){
		$sua_ten_hnc=$('#ip_sua_chu_de').val();
		$sua_mo_ta = $('#ip_sua_mo_ta').val();
		$sua_linh_vuc_lq = $('#ip_sua_linh_vuc_lq').val();
		$id = $('#id-sua-hidden').val();
		if($sua_ten_hnc!=null){
			$.get('suaHNC/'+ $id +'/'+$sua_ten_hnc+'/'+$sua_mo_ta+'/'+$sua_linh_vuc_lq,
				function(data,status){
					console.log(data)
						$('#sua-Modal').modal('hide');
						if(status == "success"){
							if(data == "true"){
								$('#'+$id).empty();
								$html1='<strong><i class="fa fa-book margin-r-5"></i>'+
									$sua_ten_hnc+
								'</strong>\
				                  <p class="text-muted">'+
				                  	$sua_mo_ta+
				                  '</p>';
				                $('#'+$id).append($html1);
								$html = '<div id="alertok" class="alert alert-success" style="position:fixed;bottom:10px;right:10px;">\
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
									  <strong>Thành công!</strong> Đã sửa dữ liệu trong CSDL\
									</div>\
									';
								$('#alertok').remove();
								$('#main-content').append($html);
								$('#alertok').delay(5000).fadeOut('fast');
							}
							else{
								$html = '<div id="alertfail" class="alert alert-danger" style="position:fixed;bottom:10px;right:10px;">\
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
									  <strong>Thất bại!</strong> Đã có lỗi xảy ra,vui lòng kiểm tra lại thông tin\
									</div>\
									';
								$('#alertfail').remove();
								$('#main-content').append($html);
								$('#alertfail').delay(5000).fadeOut('fast');
							}
						}
				});
		};

	});
}
function onclickXoa(){
	$('.btn-xoa-hnc').click(function(){

		$('#xoa-Modal').modal('show');
		$id = $(this).siblings(':hidden').val();
		$('#id-xoa-hidden').val($id);
		$(this).parent().parent().attr('id',$id);
		//$('#test123').val();
	});
}

function xoaHnc(){
	$('#btn-xac-nhan-xoa').click(function(){
		$id = $('#id-xoa-hidden').val();
		$.get('xoaHNC/'+$id,
			function(data , status){
						console.log(data)
						$('#xoa-Modal').modal('hide');
						if(status == "success"){
							if(data == "true"){
								$("#"+$id).remove();
								$html = '<div id="alertok" class="alert alert-success" style="position:fixed;bottom:10px;right:10px;">\
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
									  <strong>Thành công!</strong> Đã xóa dữ liệu trong CSDL\
									</div>\
									';
								$('#alertok').remove();
								$('#main-content').append($html);
								$('#alertok').delay(5000).fadeOut('fast');
							}
							else{
								$html = '<div id="alertfail" class="alert alert-danger" style="position:fixed;bottom:10px;right:10px;">\
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>\
									  <strong>Thất bại!</strong> Đã có lỗi xảy ra,vui lòng kiểm tra lại thông tin\
									</div>\
									';
								$('#alertfail').remove();
								$('#main-content').append($html);
								$('#alertfail').delay(5000).fadeOut('fast');
							}
						}
					});
	});
}