@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tài khoản
                        <small>{{ $user->name }}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{ $err }} <br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    <form action="admin/user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Tài khoản</label>
                            <input class="form-control" name="name" placeholder="Nhập tài khoản" value="{{ $user->name }}"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input readonly type="text" name="email" class="form-control" placeholder="Nhập địa chỉ email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" name="re_password" class="form-control" placeholder="Nhập lại mật khẩu">
                        </div>
                        <div class="form-group">
                            <label>Quyền tài khoản</label>
                            <p>
                                <label class="radio-inline">
                                    <input
                                        @if($user->quyen == 0)
                                            {{ 'checked' }}
                                        @endif
                                        name="quyen" value="0"type="radio">Tác giả
                                </label>
                                <label class="radio-inline">
                                    <input
                                        @if($user->quyen == 1)
                                        {{ 'checked' }}
                                        @endif
                                        name="quyen" value="1" type="radio">Admin
                                </label>
                            </p>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection