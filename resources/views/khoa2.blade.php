@extends('layouts.temp')

@section('dieuhuong')
	<li class=" treeview">
          <a href="#">
            <i class="fa fa-address-card"></i> <span>Quản lí tài khoản giảng viên</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="open-ds-gv" href="#">Danh sách giảng viên</a></li>
            <li><a id="open-upload-gv" href="#">Khởi tạo bằng excel</a></li>
            <li><a id="open-add-gv" href="#">Thêm thủ công</a></li>

          </ul>
        </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-user-o"></i> <span>Quản lí tài khoản sinh viên</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a id="open-ds-sv" href="#">Danh sách sinh viên</a></li>
            <li><a id="open-upload-sv" href="#">Khởi tạo bằng excel</a></li>
            <li><a id="open-add-sv" href="#">Thêm sinh viên thủ công</a></li>
          </ul>
        </li>

        <li class=" treeview">
          <a href="#">
            <i class="fa fa-bars"></i> <span>Khóa học và đào tạo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a id="open-khoahoc" href="#">Khóa học</a></li>
            <li><a id="open-ctdt" href="#">Chương trình đào tạo</a></li>
          </ul>
        </li>
  </li>
@endsection
@section('main-content')

	 <h1 style="margin-top: 0px;" id="hhh" >Đây là trang admin của khoa {{$ten_khoa}} </h1>
   <div id="wait" class="alert alert-success" style="position:fixed;bottom:10px;right:10px;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                  <i class="fa fa-refresh fa-spin"></i>
                  <strong>Đang xử lý...</strong>
                </div>
@endsection

<div class="example-modal">
        <div class="modal fade" id="modal1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thêm mới khóa học</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <label class="col-sm-3">Tên khóa học</label>
                  <div class="col-sm-9">
                    <input class="form-control" id="ip_tenkhoahoc" type="text" placeholder="Tên khóa học">
                  </div>
                </div>

              </div>
              <!-- end modal body !-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="saveKhoahoc">Lưu</button>
              </div>
            </div>o
            <!-- /.mdal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</div>
      <!-- /.example-modal -->

<div class="example-modal">
        <div class="modal fade" id="modal2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thêm chương trình đào tạo</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <label class="col-sm-3">Tên CDTD</label>
                  <div class="col-sm-9">
                    <input class="form-control" id="ip_tenctdt" type="text" placeholder="Tên chương trình đào tạo">
                  </div>
                </div>

              </div>
              <!-- end modal body !-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="saveCtdt">Lưu</button>
              </div>
            </div>o
            <!-- /.mdal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</div>

@section('nguoi-dang-nhap')
	Khoa {{$ten_khoa}}
@endsection
@section('js_import')
 <script src="dist/js/adkhoa/api.js"></script>
  <script src="dist/js/adkhoa/handleEventAdminKhoa.js"></script>
  <script src="dist/js/adkhoa/eventAtGv.js"></script>
  <script src="dist/js/adkhoa/eventAtSv.js"></script>
  <script src="dist/js/adkhoa/eventAtKhCtdt.js"></script>
@endsection

