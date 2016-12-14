$(document).ready(function() {
	listBomon();
	listLinhvuc();
});

var a = 7;

function handleTable(data) {
	// body...
	for (var i = data.length - 1; i >= 0; i--) {
		$('#bomon'+i).click({i: i}, function (event) {
			// body...
			a = event.data.i;
			J2lib.ajaxGet('listGvbm/'+(event.data.i+1), function (data) {
				// body...
				appendTable(data);
			})
		});
	}
}

function listBomon() {
	// body...
	J2lib.ajaxGet('listBomon', function (data) {
		// body...
		handleTable(data);
	});
}


function appendTable(data) {
	// body...
	console.log(a);
	var liContent = '';
	for (var i = data.length - 1; i >= 0; i--) {
		liContent += '<li class="giangvienInfo" stt="'+ data[i].user_id+'">\n\
                      <img src="dist/img/user1-128x128.jpg" alt="User Image">\n\
                      <a class="users-list-name" href="#">'+data[i].name+'</a>\n\
                      <span class="users-list-date">'+data[i].ma_giang_vien+'</span>\n\
                    </li>\n';
		//data[i]
	}

	//console.log(liContent);
	$('#listGvLayRa').empty();
	var ten_bo_mon_selected = $('#bomon'+a).children('td')[1].innerHTML;
	var content = '<div class="box box-danger">\
                <div class="box-header with-border">\
                  <h3 class="box-title">Danh sách gồm '+ data.length +' giảng</br> viên thuộc bộ môn ' +  ten_bo_mon_selected + '</h3>\
                  <div class="box-tools pull-right">\
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>\
                    </button>\
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>\
                    </button>\
                  </div>\
                </div>\
                <!-- /.box-header -->\
                <div class="box-body no-padding">\
                  <ul class="users-list clearfix">'
                  + liContent +
                  '</ul>\
                  <!-- /.users-list -->\
                </div>\
                <!-- /.box-body -->\
                <div class="box-footer text-center">\
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>\
                </div>\
                <!-- /.box-footer -->\
              </div>\
              <!--/.box -->\
            </div>';
	$('#listGvLayRa').append(content);
	hienThiThongTinGv(data);
}

function hienThiThongTinGv(data) {
	// body...
	$('.giangvienInfo').click(function () {
		// body...
		J2lib.ajaxGet('infoGV/'+($(this).attr('stt')), function (data) {
			// body...
			console.log(data);
			modelBox(data);
		});
	});

	function modelBox(data) {
		// body...
		$('#myModal').remove();
		console.log(data);
		var liContent ='';
		if(data[0].ten_huong_nghien_cuu == null	){
			liContent+= ' <li class="list-group-item">Chưa có hướng nghiên cứu nào</li>';
		} else {
			for (var i = data.length - 1; i >= 0; i--) {
				liContent+= ' <li class="list-group-item">\
                  '+ data[i].ten_huong_nghien_cuu +'\
                </li>';
			}
		}
		//$('#listHuongNghienCuu').empty();
		console.log(liContent);
		var modelContent = '\
        <div class="modal fade" id="myModal" role="dialog">\
          <div class="modal-dialog">\
            <div class="modal-content">\
              <div class="modal-header">\
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                  <span aria-hidden="true">&times;</span></button>\
                <h4 class="modal-title">Thông tin giảng viên</h4>\
              </div>\
              <div class="modal-body">\
              	<img class="profile-user-img img-responsive img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture">\
              <h3 class="profile-username text-center">'+ data[0].name +'</h3>\
              <p class="text-muted text-center">Software Engineer</p>\
              <ul class="list-group list-group-unbordered">\
                <li class="list-group-item">\
                  <b>Mã giảng viên</b> <a class="pull-right">'+ data[0].ma_giang_vien +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Email</b> <a class="pull-right">'+ data[0].email +'</a>\
                </li>\
                <li class="list-group-item">\
                  <b>Các hướng nghiên cứu của giảng viên này</b>\
                </li>\
                '+ liContent +'\
              </ul>\
                \
              </div>\
            </div>\
            <!-- /.modal-content -->\
          </div>\
          <!-- /.modal-dialog -->\
        </div>\
        <!-- /.modal -->\
      </div>\
      <!-- /.example-modal -->\
			    </div>\
			  </div>\
			</div>';
		
		$('#listGvLayRa').append(modelContent);

		$('#myModal').modal('show');
	}
}


function listLinhvuc() {
	// body...
		// body...
	J2lib.ajaxGet('listLinhvuc', function (data) {
		// body...
		handleLinhvucTable(data);
	});
}


function handleLinhvucTable(data) {
	// body...
	for (var i = data.length - 1; i >= 0; i--) {
		$('#linhvuc'+i).click({i: i}, function (event) {
			// body...
			a = event.data.i;
			J2lib.ajaxGet('listGvLv/'+(event.data.i+1), function (data) {
				// body...
				appendLinhvucTable(data);
			})
		});
	}
}


function appendLinhvucTable(data) {
	// body...
	var liContent = '';
	for (var i = data.length - 1; i >= 0; i--) {
		liContent += '<li class="giangvienInfo" stt="'+ data[i].user_id+'">\n\
                      <img src="dist/img/user1-128x128.jpg" alt="User Image">\n\
                      <a class="users-list-name" href="#">'+data[i].name+'</a>\n\
                      <span class="users-list-date">'+data[i].ma_giang_vien+'</span>\n\
                    </li>\n';
		//data[i]
	}
	//console.log(liContent);
	$('#listGvLayRa').empty();
	//var  = 'ád';
	console.log('sdfds');
	var ten_linh_vuc_selected = $('#linhvuc'+a).children('td')[1].innerHTML;
	var content = '<div class="box box-danger">\
                <div class="box-header with-border">\
                  <h3 class="box-title">Danh sách gồm '+ data.length +' giảng</br> viên thuộc lĩnh vực '+ ten_linh_vuc_selected+ '</h3>\
                  <div class="box-tools pull-right">\
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>\
                    </button>\
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>\
                    </button>\
                  </div>\
                </div>\
                <!-- /.box-header -->\
                <div class="box-body no-padding">\
                  <ul class="users-list clearfix">'
                  + liContent +
                  '</ul>\
                  <!-- /.users-list -->\
                </div>\
                <!-- /.box-body -->\
                <div class="box-footer text-center">\
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>\
                </div>\
                <!-- /.box-footer -->\
              </div>\
              <!--/.box -->\
            </div>';
	$('#listGvLayRa').append(content);
	hienThiThongTinGv(data);
}