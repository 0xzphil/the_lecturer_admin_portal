@extends('pages.layout.nav-top-1')

@section('container')
<section class="content">
        
        <!-- <div class="callout callout-danger">
          <h4>Warning!</h4>

          <p>The construction of this layout differs from the normal one. In other words, the HTML markup of the navbar
            and the content will slightly differ than that of the normal layout.</p>
        </div> -->
        <div class="box box-default">
        <div class="box-header with-border">
        <h3 class="box-title">Đăng nhập</h3>
        </div>

        {{ Form::open()}}
            <div class="box-body">
                

                <div class="form-group">
                {{ Form::label('exampleInputEmail1', 'Địa chỉ email')}}

                {{ Form::email('email', null, ['class'=>'form-control', 'id' => 'exampleInputEmail1','foo' => 'bar' , 'placeholder'=>'Nhập địa chỉ email'])}}

                </div>

                <div class="form-group">
                {{ Form::label('exampleInputPassword1', 'Mật khẩu')}}

                {{ Form::password('password', ['class'=>'form-control', 'id' => 'exampleInputPassword1', 'placeholder'=>'Nhập password'])}}

                </div>
                <div class="box-footer">
                {{ Form::submit('submit', ['class'=>'btn btn-primary'])}}
                </div>
            </div>
        {{ Form::close()}}
        
        </div>
        <!-- /.box -->
      </section>
      @if($errors->any())
                @foreach($errors->all() as $error)
                    <li>
                    {{ $error }}
                    </li>
                @endforeach
            @endif
@endsection