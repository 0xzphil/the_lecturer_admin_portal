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
            <li><a id="open-add-gv" href="#">abc</a></li>

          </ul>
        </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Đề tài</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Auth::user()->sinh_vien->dang_ky==1 and Auth::user()->sinh_vien->khoa->dang_ky==1)
            <li><a id="open-de-tai" >Đăng ký đề tài</a></li>

            @else
            <li><a> Bạn không đủ điều kiện<br/> đăng ký đề tài</a></li>
            @endif
            <!-- 
            <li><a id="open-add-sv" href="#">Thêm GV thủ công</a></li>
 -->
          </ul>
        </li>
@endsection
@section('main-content')
   <section class="content-header">
      <h1>
        Sinh viên Browser
      </h1>
    </section>
    <section class="content" id="content">
        <input type="hidden" name="gvdata" id="gvdata" value="{{ Sismgr::listGv('form1') }}">
        <div class="row" >
        <div class="col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách đơn vị khoa {{ $bo_mons[0]->khoa->ten_khoa }}</h3>
           
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Tên bộ môn</th>
                  <th>Mô tả</th>
                </tr>
                @foreach ($bo_mons as $key=>$bo_mon)
                <tr id="bomon{{$key}}">
                  <td>{{ $bo_mon->id }}</td>
                  <td>{{ $bo_mon->ten_bo_mon }}</td>
                  <td>{{ $bo_mon->mo_ta }}</td>
                  
                </tr>
                @endforeach
                
                
              </table>
            </div>
            <!-- /.box-body -->
        </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách lĩnh vực</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Mô tả</th>
                </tr>
                @foreach($linh_vuc_cbs as $key=> $linh_vuc_cb)
                <tr id="linhvuc{{$key}}">
                  <td>{{ $linh_vuc_cb->id }}</td>
                  <td>{{ $linh_vuc_cb->ten_linh_vuc }}</td>
                  <td>{{ $linh_vuc_cb->mo_ta }}</td>
                </tr>
                @endforeach
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- md6-->
        </div>
        <div class="col-md-4" id='listGvLayRa'>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Khoa {{ $bo_mons[0]->khoa->ten_khoa }} bao gồm {{ Sismgr::soLuongGv() }} giảng viên</h3>
           	</div>
          </div>
        </div>
      </div>
      
    </section>

    <section class="content">
        
    </section>


@endsection
@section('nguoi-dang-nhap')
	SV {{Auth::user()->name}}
@endsection


@section('js_import')
<script src="dist/js/sv/handleEventSinhVien.js"></script>
<script src="dist/js/sv/handleTableSvbr.js"></script>
<script src="dist/js/j2lib.js"></script>

<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>


@endsection