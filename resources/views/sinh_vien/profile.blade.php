@extends('layouts.temp')

@section('dieuhuong')
	<li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Thông tin sinh viên</span>
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
        Thông tin sinh viên
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="row">
      


          <!-- /.box -->
        </div>
        <!-- /.col -->
        
      <!-- /.row -->

    </section>
@endsection
@section('nguoi-dang-nhap')
	SV {{Auth::user()->name}}
@endsection