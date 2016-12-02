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
				        	$html += '<option value='+linhvuc[i].id+">"+linhvuc[i].ten+"</option>";
				        }
				        $html +='</select>\
				      </div>\
				    </div>\
				    <div class="form-group">\
				    	<div class="col-sm-2"></div>\
				    	<div class="col-sm-8">\
				     	<button id="saveHnc" class="btn btn-info">Lưu</button>\
				     	<a class="btn btn-danger" href="/">Thoát</a></div>\
				    </div>\
             </div> </form></div></div>';
        $("#main-content").append($html);
        saveHnc();
        //luuGV();
	});
}

function saveHnc(){
}
function getListLinhVuc(){
	$.get('listLvcb',function(data,status){
		if(status == 'success'){
			//console.log(data);
			//linhvuc = JSON.parse(data);
			linhvuc = data;
			console.log(linhvuc);
		}
	});
}