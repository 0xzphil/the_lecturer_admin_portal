@extends('layouts.temp')

@section('dieuhuong')
	<li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Thông tin giảng viên</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="repass-gv" href="#">Đổi mật khẩu</a></li>
            <li><a id="open-add-gv" href="#">Thêm GV thủ công</a></li>

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
            <li><a id="open-upload-sv" href="#">Khởi tạo bằng excel</a></li>
            <li><a id="open-add-sv" href="#">Thêm GV thủ công</a></li>
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
            <div class="box-body">
              @foreach( Auth::user()->giang_vien->huong_nghien_cuu as $huong_nghien_cuu)
                  <strong><i class="fa fa-book margin-r-5"></i> {{$huong_nghien_cuu->ten_huong_nghien_cuu }}</strong>

                  <p class="text-muted">
                  {{$huong_nghien_cuu->mo_ta }}
                  </p>

                  <hr>
              @endforeach
              

             
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
@endsection