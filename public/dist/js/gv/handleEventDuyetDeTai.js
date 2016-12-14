$(document).ready(function() {
	duyetDeTai();
	xemDeTaiQuanLi();
});
/**
 * [duyetDeTai description]
 * @return {[type]} [description]
 */
function duyetDeTai() {
	// body...
	$('#open-duyet-de-tai').click(function () {
		// body...
		
		J2lib.ajaxGet('listDeTai', function (data) {
			// body...
			xuLi(data);
		});
	});
}
/**
 * [xuLi description]
 * @param  {[type]} data [description]
 * @return {[type]}      [description]
 */
function xuLi(data) {
	// body...
	
	$('#main-content').empty();
	var liContent = '';
	for (var i = data.length - 1; i >= 0; i--) {
		liContent += '<li>\
              <i class="fa fa-user bg-aqua"></i>\
              <div class="timeline-item">\
                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>\
                <h3 class="timeline-header"><a href="#">'+ data[i].ma_sinh_vien +'</a> đã có 1 yêu cầu duyệt đề tài</h3>\
                <div class="timeline-body">\
                  ' + data[i].ten_de_tai +'...\
                </div>\
                <div class="timeline-footer">\
                  <a class="btn btn-primary btn-xs chap-nhan-button" msv="'+ data[i].ma_sinh_vien +'">Chấp nhận</a>\
                  <a class="btn btn-danger btn-xs tu-choi-button" msv="'+ data[i].ma_sinh_vien +'">Trùng và từ chối</a>\
                </div>\
              </div>\
            </li>';
	}
	console.log(data.length);
	var content;
	if(data.length == 0){
		liContent = '<li>\
              <i class="fa fa-user"></i>\
              <div class="timeline-item">\
                <h3 class="timeline-header"><a href="#"></a>Bạn không có yêu cầu duyệt đề tài nào</h3>\
              </div>\
            </li>';
	};
	var content = '<section class="content-header">\
	      <h1>\
	        Quản lí đề tài\
	      </h1>\
	    </section>\
	    <section class="content">\
	      <!-- row -->\
	      <div class="row">\
	        <div class="col-md-12">\
	          <!-- The time line -->\
	          <ul class="timeline">\
	            <!-- timeline time label -->\
	            <li class="time-label">\
	                  <span class="bg-red">\
	                    Dòng đề tài đăng ký\
	                  </span>\
	            </li>\
	            <!-- /.timeline-label -->\
	            <!-- timeline item -->'
	            + liContent +
	            '<!-- END timeline item -->\
	            <!-- timeline item -->\
	            \
	            <li>\
	              <i class="fa fa-clock-o bg-gray"></i>\
	            </li>\
	            <!-- END timeline item -->\
	            <!-- timeline time label -->\
	          </ul>\
	        </div>\
	        <!-- /.col -->\
	      </div>\
	    </section>';
	console.log(data);
	$('#main-content').append(content);

	chapNhan();
	tuChoi();
}
/**
 * [chapNhan description]
 * @return {[type]} [description]
 */
function chapNhan() {
	// body...
	$('.chap-nhan-button').click(function(event) {
		/* Act on the event */
		console.log($(this).attr('msv'));
		var msv = $(this).attr('msv');
		J2lib.ajaxGet('deTai/chapNhan/'+msv, function (data) {
			// body...
			xuLi(data);
		});
	});
}
/**
 * [tuChoi description]
 * @return {[type]} [description]
 */
function tuChoi() {
	// body...
	$('.tu-choi-button').click(function(event) {
		/* Act on the event */
		console.log($(this).attr('msv'));
		var msv = $(this).attr('msv');
		J2lib.ajaxGet('deTai/trung/'+msv, function (data) {
			// body...
			xuLi(data);
		});
	});
}

function xemDeTaiQuanLi() {
	// body...
	$('#open-de-tai-da-chap-nhan').click(function (event) {
		// body...
		J2lib.ajaxGet('listDeTaiDaChapNhan', function (data) {
			// body...
			xuLiDeTaiDaChapNhan(data);
		});
	});
}

function xuLiDeTaiDaChapNhan(data) {
	// body...
	$('#main-content').empty();
	var trContent = '';
	for (var i = data.length - 1; i >= 0; i--) {
		var trungContent;
		if(data[i].trung == 1){
			trungContent = '<span class="badge bg-red">Trùng</span>';
		} else trungContent = '<span class="badge bg-green">Không trùng</span>';
		trContent += '<tr>\
                  <td>'+ (data.length - 1 -i+1) +'.</td>\
                  <td>'+ data[i].ma_sinh_vien +'</td>\
                  <td>'+ data[i].ten_de_tai +'</td>\
                  <td class="doiTTTrung" msv="'+ data[i].ma_sinh_vien +'">'+ trungContent +'</td>\
                </tr>';
	}
	var content = '<section class="content-header">\
      <h1>\
        Quản lí đề tài\
      </h1>\
    </section>\
    <section class="content">\
      <div class="row">\
        <div class="col-md-12">\
          <div class="box">\
            <div class="box-header with-border">\
              <h3 class="box-title">Danh sách sinh viên của tôi</h3>\
            </div>\
            <!-- /.box-header -->\
            <div class="box-body">\
              <table class="table table-bordered">\
                <tr>\
                  <th style="width: 10px">#</th>\
                  <th>Tên sinh viên</th>\
                  <th>Tên đề tài</th>\
                  <th style="width: 140px">Đánh dấu trùng</th>\
                </tr>\
                '+ trContent +'\
              </table>\
            </div>\
          </div>\
          <!-- /.box -->\
	</section>';
	console.log(data);
	$('#main-content').append(content);
	doiTrangThai();
}

function doiTrangThai() {
	// body...
	$('.doiTTTrung').click(function(event) {
		/* Act on the event */
		var msv = $(this).attr('msv');
		J2lib.ajaxGet('deTai/trung/'+ msv, function (data) {
			// body...
			xuLiDeTaiDaChapNhan(data);
		});
	});
}