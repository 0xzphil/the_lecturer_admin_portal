@extends('layouts.temp')

@section('dieuhuong')
	<li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Quản lí tài khoản giảng viên</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="open-ds-gv" href="#">Danh sách giảng viên</a></li>
            <li><a id="open-upload-gv" href="#">Khởi tạo bằng excel</a></li>
            <li><a id="open-add-gv" href="#">Thêm GV thủ công</a></li>

          </ul>
        </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Quản lí tài khoản sinh viên</span>
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
	 <h1 style="margin-top: 0px;" id="hhh" >Đây là trang admin của khoa {{$ten_khoa}} </h1>
@endsection
@section('nguoi-dang-nhap')
	Khoa {{$ten_khoa}}
@endsection