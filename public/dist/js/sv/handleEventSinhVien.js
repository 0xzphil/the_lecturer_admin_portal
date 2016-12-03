

$(document).ready(function() {
	nhapDeTai();
});


function getListBomon(argument) {
	// body...
	
}

function getListLvcb(argument) {
	// body...
}


function nhapDeTai() {
	// body...
  var gvdata = $.parseJSON($('#gvdata').val());
	$('#open-de-tai').click(function () {
		// body...
		console.log(gvdata[0]);
		$('#content').empty();

    var optionHtml = '';
    for (var i = gvdata.length - 1; i >= 0; i--) {
      if (i == gvdata.length - 1) {
        optionHtml += '<option selected="selected" value="'+ gvdata[i].user_id +'">'+ gvdata[i].name +'</option>\n';
      } else 
      optionHtml += '<option value="'+ gvdata[i].user_id +'">'+ gvdata[i].name +'</option>\n';
    }

    console.log(optionHtml);
		var formDeTai = '<section class="content">\
		<div class="box box-default">\
        <div class="box-header with-border">\
          <h3 class="box-title">Đăng ký đề tài</h3>\
          <div class="box-tools pull-right">\
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>\
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>\
          </div>\
        </div>\
        <!-- /.box-header -->\
        <div class="box-body">\
          <div class="row">\
            <div class="col-md-6">\
              <div class="form-group">\
                <label>Tên giảng viên</label>\
                <select class="form-control select2" id="chon-gv" style="width: 100%;">'
                  + optionHtml +
                '</select>\
              </div>\
              <!-- /.form-group -->\
              <div class="form-group">\
                <label>Tên đề tài</label>\
                <select class="form-control select2" disabled="disabled" style="width: 100%;">\
                  <option selected="selected">Alabama</option>\
                  <option>Alaska</option>\
                  <option>California</option>\
                  <option>Delaware</option>\
                  <option>Tennessee</option>\
                  <option>Texas</option>\
                  <option>Washington</option>\
                </select>\
              </div>\
              <!-- /.form-group -->\
            </div>\
            </div>\
            </div>';
        $('#content').append(formDeTai);
        $(function () {
        		//Initialize Select2 Elements
    	    	$(".select2").select2();
        });

        $('#chon-gv').change(function() {
          /* Act on the event */
          console.log($('#chon-gv').val());
        });
    });
        
}

function function_name(argument) {
	// body...
}