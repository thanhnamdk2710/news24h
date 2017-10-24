@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Thông tin tài khoản</h3></div>
                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="/user/{{$user->id}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" class="form-control" placeholder="Username" name="name" value="{{$user->name}}" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}" aria-describedby="basic-addon1"
                                       disabled
                                >
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="re_password" aria-describedby="basic-addon1">
                            </div>
                            <button type="submit" class="btn btn-primary">Sửa
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@stop
