@extends('layouts.temp')

@section('dieuhuong')
	<input type="hidden" id="hiddenMgv" value="{{Auth::user()->giang_vien->ma_giang_vien}}">
	<li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>
            Thông tin giảng viên</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="repass-gv" href="#">Đổi mật khẩu</a></li>

          </ul>
        </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Quản lí đề tài</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="open-duyet-de-tai" href="#">Duyệt đề tài</a></li>
            <li><a id="open-de-tai-da-chap-nhan" href="#">Đề tài đã chấp nhận</a></li>
          </ul>
        </li>
@endsection
@section('main-content')
   <section class="content-header">
      <h1>
        Thông tin giảng viên
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="row">
      <meta name="csrf_token" content="{!! csrf_token() !!}"/>
          <div class="content">
          <!-- Profile Image -->
          <div class="box box-primary" id="gvcontent">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

              <p class="text-muted text-center">Bộ môn {{ Auth::user()->giang_vien->bo_mon->ten_bo_mon }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Mã giảng viên</b> <a class="pull-right">{{ Auth::user()->giang_vien->ma_giang_vien }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Khoa</b> <a class="pull-right">{{ Auth::user()->giang_vien->bo_mon->khoa->ten_khoa }}</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block" id="editgv"><b>Chỉnh sửa</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- Các hướng nghiên cứu Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Các hướng nghiên cứu</h3>
              <div style="float:right;"><input type="button" id="btn-add-hnc" value="Thêm hướng nghiên cứu" class="btn btn-primary"></div>
            </div>

            <!-- /.box-header -->
            <div class="box-body" style="border-bottom: solid;border: 1px">
              @foreach( Auth::user()->giang_vien->huong_nghien_cuu as $huong_nghien_cuu)
              <div class="col-sm-12">
              <div class="col-sm-10" >
                  <strong><i class="fa fa-book margin-r-5"></i> {{$huong_nghien_cuu->ten_huong_nghien_cuu }}</strong>
                  <p class="text-muted">
                  {{$huong_nghien_cuu->mo_ta }}
                  </p>

              </div>
              <div class="col-sm-2">
                <input type="hidden" value="{{$huong_nghien_cuu->id}}" >
                <input style="float:right;margin-left: 5px" type="button" value="Xóa" class="btn btn-danger btn-xoa-hnc">
                <input style="float: right" type="button" value="Sửa" class="btn btn-info btn-sua-hnc">
              </div>
                 
              <hr  width="100%" size="2px" align="center" color="black" />
              </div> 
              @endforeach

                <div class="modal fade" id="xoa-Modal" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><b>Xác Nhận</b></h3>
                      </div>
                      <div class="modal-body">
                        <input id="id-xoa-hidden" type="hidden">
                        <p style="font-size: 20px">Bạn có chắc chắn muốn xóa dữ liệu này?</p>
                      </div>
                      <div class="modal-footer">
                        <div style="width: 50%;float: right;">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Hủy</button>
                        </div>
                          <div style="width: 50%;float: left;"><button type="button" id="btn-xac-nhan-xoa" class="btn btn-danger" style="float: left;" >Xóa</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="sua-Modal" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><b>Chỉnh sửa thông tin</b></h3>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" id="id-sua-hidden">
                        <input id="id-sua-hidden" type="hidden">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Chủ đề</label>
                          <div class="col-sm-10">
                            <input class="form-control" id="ip_sua_chu_de" type="text" placeholder="Nhập chủ đề">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Mô Tả</label>
                          <div class="col-sm-10">
                            <input class="form-control" id="ip_sua_mo_ta" type="text" placeholder="Mô tả">
                          </div>
                        </div>
                         <div class="form-group">
                          <label class="col-sm-2 control-label">Lĩnh vực liên quan</label>
                          <div class="col-sm-10">
                            <select multiple class="form-control" id="ip_sua_linh_vuc_lq">
                              
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div style="width: 50%;float: right;">
                          <a class="btn btn-primary" data-dismiss="modal">Hủy</a>
                        </div>
                          <div style="width: 50%;float: left;"><a id="btn-cap-nhat" class="btn btn-success" style="float: left;" >Cập Nhật</a>
                        </div>                      
                      </div>
                    </div> 
                  </div>
                </div>    
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        
      <!-- /.row -->

    </section>
@endsection
@section('nguoi-dang-nhap')
	GV {{Auth::user()->name}}
@endsection


@section('js_import')
<script src="dist/js/gv/handleEventGiangVien.js"></script>
<script src="dist/js/gv/eventgiangvien1.js"></script>
<script src="dist/js/j2lib.js"></script>
<script src="dist/js/gv/handleEventDuyetDeTai.js"></script>
@endsection