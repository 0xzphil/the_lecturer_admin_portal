
$(document).ready(function() {
	editGV();
});


function editGV() {
	// body...
	$('#editgv').click(function() {
		/* Act on the event */
		$('#gvcontent').empty();
		var editContent = '<div class="box-header with-border">\
            <h3 class="box-title">Thông tin chỉnh sửa</h3>\
            </div>\
            <!-- /.box-header -->\
            <div class="box-body">\
              <form role="form">\
                <!-- text input -->\
                <div class="form-group">\
                  <label>Tên</label>\
                  <input type="text" id="gv_name" name="name" class="form-control" placeholder="Enter ...">\
                </div>\
                <div class="form-group">\
                  <label>Mã giảng viên</label>\
                  <input type="text" id="gv_mgv" name="mgv" class="form-control" placeholder="Enter ...">\
                </div>\
                <div class="form-group">\
                  <label>Email</label>\
                  <input type="text" id="gv_email" name="email" class="form-control" placeholder="Enter ...">\
                </div>\
                <a href="#" class="btn btn-primary btn-block" id="confirmgv"><b>Xác nhận</b></a>\
                ';
		$('#gvcontent').append(editContent);
		confirmGV();
	});
}

function confirmGV() {
	// body...
	$('#confirmgv').click(function() {
	    var name  = $('#gv_name').val();
	    var mgv   = $('#gv_mgv').val();
	    var email = $('#gv_email').val();
	    console.log(name);
		$.ajax({
	        url: "editGV",
	        type: "POST",
	        contentType : 'application/x-www-form-urlencoded',
	        beforeSend: function (xhr) {
	            var token = $('meta[name="csrf_token"]').attr('content');
	            if (token) {
	                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },
	        data: { name: name, email: email, mgv: mgv},

	        success: function(data){
	        	console.log(data);
	        }, 

	        error: function(data){
	        	var errors = $.parseJSON(data.responseText); 
	        	console.log(data);
	            console.log(data.responseText);
	        }
    	});
	});
}

