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
   <section class="content">
   <div class="col-md-12">
   <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Danh sách giảng viên</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Mã cán bộ</th>
                    <th>Họ tên</th>
                    <th>Đơn vị</th>
                    <th>VNU Email</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($listGV as $giang_vien)
                    <tr>
                    <td><a href="pages/examples/invoice.html">{{ $giang_vien->user_id }}</a></td>
                    <td>
                      {{ $giang_vien->ma_giang_vien }}
                    </td>
                    <td>
                      {{ $giang_vien->name }}
                    </td>
                    <td>
                      {{ $giang_vien->ten_bo_mon }}
                    </td>
                    <td>
                      {{ $giang_vien->email }}
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Thêm giảng viên</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Xem tất cả giảng viên</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        </div>
      </section>
        <!-- /.col -->
@endsection
@section('nguoi-dang-nhap')
	Khoa 
@endsection