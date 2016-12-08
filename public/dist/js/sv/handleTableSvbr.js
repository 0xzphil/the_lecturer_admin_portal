$(document).ready(function() {
	listBomon();
	listLinhvuc();
});
var a = 7;

function handleTable(data) {
	// body...
	console.log(data.length);

	for (var i = data.length - 1; i >= 0; i--) {
		console.log(i+1);
		$('#bomon'+i).click({i: i}, function (event) {
			// body...
			a = event.data.i;
			J2lib.ajaxGet('listGvbm/'+(event.data.i+1), function (data) {
				// body...
				//console.log(event.data.i+1);
				appendTable(data);
			})
		});
		//data[i]
	}
	console.log(data);
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
                  <b>Friends</b> <a class="pull-right">13,287</a>\
                </li>\
              </ul>\
                <p>One fine body&hellip;</p>\
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
	console.log(data.length);

	for (var i = data.length - 1; i >= 0; i--) {
		console.log(i+1);
		$('#linhvuc'+i).click({i: i}, function (event) {
			// body...
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
	//var ten_bo_mon_selected = $('#bomon'+a).children('td')[1].innerHTML;
	var content = '<div class="box box-danger">\
                <div class="box-header with-border">\
                  <h3 class="box-title">Danh sách gồm '+ data.length +' giảng</br> viên thuộc bộ môn </h3>\
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