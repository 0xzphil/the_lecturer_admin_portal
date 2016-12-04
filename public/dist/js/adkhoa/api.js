
//tạo alert thông báo cho người dùng ở góc bên phải màn hình
function createAlert($type , $data){
	$html = '<div id="alertA" class="alert alert-'+$type+'" style="position:fixed;bottom:10px;right:10px;">\
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'+
								  $data +'</div>';
	$('#alertA').remove();
	$('#main-content').append($html);
	$('#alertA').delay(5000).fadeOut('fast');
}

