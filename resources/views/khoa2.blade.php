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

        <li class=" treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Quản lý đăng ký đề tài</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" id="treeQldt">
             <li><a id="open-khoitao" href="#">Khởi tạo</a></li>
            <li><a id="open-svddk" href="#">Sinh viên và đề tài</a></li>
            @if ( Auth::user()->nhan_vien_khoa->khoa->dang_ky)            
             <li><a id="close-time-dk" href="#" data-toggle="modal" data-target="#modal4">Đóng đợt đăng ký</a></li>
             @else
              <li><a id="open-time-dk" href="#">Mở đợt đăng ký</a></li>
              @endif
          </ul>
        </li>

        <li class=" treeview">
          <a href="#">
            <i class="fa fa-pencil-square-o"></i> <span>Quản lý đăng ký bảo vệ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a id="dsdtbv" href="#">Danh sách đăng ký bảo vệ</a></li>
            <li><a id="chotdsbv" href="#">Chốt danh sách bảo vệ</a></li>
          </ul>
        </li>

        <li class=" treeview">
          <a href="#">
            <i class="fa fa-graduation-cap"></i> <span>Bảo vệ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a id="dsbvdt" href="#">Danh sách bảo vệ</a></li>
            <li><a id="xdghdbv" href="#">Xuất đề nghị hội đồng bảo vệ</a></li>
          </ul>
        </li>

        <li class=" treeview">
          <a href="#">
            <i class="fa fa-file-text"></i> <span>Công văn</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a id="cv" href="#">Tất cả</a></li>
            <!-- <li><a id="#" href="#">Hủy</a></li> -->
            <!-- <li><a id="#" href="#">Thay đổi</a></li> -->
          </ul>
        </li>
  </li>
@endsection
@section('main-content')
   <section class="content">
      <h1 style="margin-top: 0px;" id="h1khoa"> Khoa {{$ten_khoa}} </h1>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 id="h3slgv">{{App\Giang_vien::all()->count()}}</h3>

              <p>Giảng viên</p>
            </div>
            <div class="icon" style="padding-top:10px;">
              <i class="fa fa-address-card"></i>
            </div>
            <a href="#" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="h3slsv">{{App\Sinh_vien::all()->count()}}</h3>

              <p>Sinh viên</p>
            </div>
            <div class="icon" style="padding-top: 10px;">
              <i class="fa fa-user-o"></i>
            </div>
            <a href="#" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="h3slbm">{{App\Bo_mon::whereRaw('khoa_id = ?',[Session::get('khoa_id')])->get()->count()}}</h3>

              <p>Bộ môn</p>
            </div>
            <div class="icon" style="padding-top: 10px;">
              <i class="fa fa-paper-plane-o"></i>
            </div>
            <a href="#" class="small-box-footer">Xem thêm<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="h3slptn">{{App\Phong_thi_nghiem::whereRaw('khoa_id = ?',[Session::get('khoa_id')])->get()->count()}}</h3>

              <p>Phòng thí nghiêm</p>
            </div>
            <div class="icon" style="padding-top: 10px;">
              <i class="fa fa-filter"></i>
            </div>
            <a href="#" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </section>
@endsection
<!--Modal thêm mới 1 khóa học vào danh sách khóa học -->
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
<!--kết thúc modal thêm mới 1 khóa học -->

<!-- Modal thêm chương trình đào tạo  -->
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
<!--Hết modal thêm chương trình đào tạo-->

<!-- Modal thêm sinh viên vào danh sách được đăng ký  -->
<div class="example-modal">
        <div class="modal fade" id="modal3">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thêm sinh viên vào danh sách được đăng ký</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <label class="col-sm-2" style="padding-right: 0px;">Mã sinh viên</label>
                  <div class="col-sm-6">
                    <input class="form-control col-sm-10" id="ip_msv_ddk" type="text" placeholder="Nhập mã sinh viên">
                    
                  </div>
                  <span class="col-sm-4" id="wsvddk" style="display:none;color:#dd4b39">Mã sinh viên phải gồm 8 số</span>
                </div>

              </div>
              <!-- end modal body !-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="save-sv-ddk">Lưu</button>
              </div>
            </div>o
            <!-- /.mdal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</div>
<!--Hết modal thêm mới sinh viên vào danh sách được đăng ký-->

<!-- Modal đóng đăng ký  -->
<div class="example-modal">
        <div class="modal fade" id="modal4">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thông báo</h4>
              </div>
              <div class="modal-body">
                <h3>Khoa {{$ten_khoa}} sẽ đóng đợt đăng ký đề tài và xuất công văn + phụ lục.</h3>
              </div>
              <!-- end modal body !-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="btnclosetimedk">Đóng đăng ký</button>
              </div>
            </div>o
            <!-- /.mdal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</div>
<!--Hết modal đóng đăng ký-->

<!-- Modal đăng ký bảo vệ  -->
<div class="example-modal">
        <div class="modal fade" id="modal5">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thông tin hồ sơ bảo vệ</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <label class="col-sm-2" style="padding-right: 0px;">Mã sinh viên</label>
                    <div class="col-sm-10">
                      <input class="form-control col-sm-10" id="ip_msv_bv" type="text" disabled="disabled">
                      
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <label class="col-sm-2" style="padding-right: 0px;">Tên sinh viên</label>
                    <div class="col-sm-10">
                      <input class="form-control col-sm-10" id="ip_tsv_bv" type="text" disabled="disabled">
                      
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <label class="col-sm-2" style="padding-right: 0px;">Tên đề tài</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" id="ip_tdt_bv" disabled="disabled"></textarea>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <label class="col-sm-2" style="padding-right: 0px;"> 
                      
                    </label>
                    <label class="col-sm-3" style="padding-right: 0px;">Hồ sơ 
                        <input type="checkbox" value="" id="cb-hs">
                    </label>
                    <label class="col-sm-3" style="padding-right: 0px;">Hợp thức 
                        <input type="checkbox" value="" id="cb-hthuc">
                    </label>
                    <label class="col-sm-3" style="padding-right: 0px;">Hoàn tất
                        <input type="checkbox" value="" id="cb-htat">
                    </label>
                  </div>

              </div>
              <!-- end modal body !-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="saveHoso">Lưu</button>
              </div>
            </div>o
            <!-- /.mdal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</div>
<!--Hết modal đăng ký bảo vệ-->

<!-- Modal gửi thông báo tới các sinh viên chưa gửi hồ sơ  -->
<div class="example-modal">
        <div class="modal fade" id="modal6">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thông báo</h4>
              </div>
              <div class="modal-body">
                <h3>Khoa {{$ten_khoa}} sẽ gửi thông báo tới tất cả các sinh viên chưa hoàn thiện, hồ sơ chưa được hợp thức.</h3>
              </div>
              <!-- end modal body !-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="btnguinhacnho">Gửi nhắc nhở</button>
              </div>
            </div>o
            <!-- /.mdal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</div>
<!--Hết modal gửi thông báo tới các sinh viên chưa gửi hồ sơ -->

<!-- Modal phân công phản biện -->
<div class="example-modal">
        <div class="modal fade" id="modal7">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thêm phân công phản biện</h4>
              </div>
              <div class="modal-body">
                 <div class="row">
                    <label class="col-sm-3" style="padding-right: 0px;">Mã giảng viên</label>
                    <div class="col-sm-9">
                      <input class="form-control col-sm-10" id="pc-mgv" type="text" placeholder="Mã giảng viên">
                      
                    </div>
                  </div>
              </div>
              <!-- end modal body !-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="btnphancong">Lưu</button>
              </div>
            </div>o
            <!-- /.mdal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</div>
<!--Hết modal thêm phân công phản biện -->


@section('nguoi-dang-nhap')
	Khoa {{$ten_khoa}}
@endsection
@section('js_import')
 <script src="dist/js/adkhoa/api.js"></script>
  <script src="dist/js/adkhoa/handleEventAdminKhoa.js"></script>
  <script src="dist/js/adkhoa/eventAtGv.js"></script>
  <script src="dist/js/adkhoa/eventAtSv.js"></script>
  <script src="dist/js/adkhoa/eventAtKhCtdt.js"></script>
  <script src="dist/js/adkhoa/eventAtQldkdt.js"></script>
  <script src="dist/js/adkhoa/eventAtQldkbv.js"></script>
  <script src="dist/js/adkhoa/eventAtBv.js"></script>
  <script src="dist/js/adkhoa/eventAtCv.js"></script>
@endsection

