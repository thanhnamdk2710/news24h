@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Hình</th>
                            <th>Tiêu đề</th>
                            <th>Tóm tắt</th>
                            <th>Thể loại</th>
                            <th>Loại tin</th>
                            <th>Xem</th>
                            <th>Nổi bật</th>
                            <th>Xóa</th>
                            <th>Sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tintuc as $tt)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $tt->id }}</td>
                            <td><img src="upload/tintuc/{{ $tt->Hinh }}" alt="" width="100px"></td>
                            <td>{{ $tt->TieuDe }}</td>
                            <td>{{ $tt->TomTat }}</td>
                            <td>{{ $tt->loaitin->theloai->Ten }}</td>
                            <td>{{ $tt->loaitin->Ten }}</td>
                            <td>{{ $tt->SoLuotXem }}</td>
                            <td>
                                @if($tt->NoiBat == 0)
                                    {{ 'Không' }}
                                @else
                                    {{ 'Có' }}
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/delete/{{ $tt->id }}"> Xóa</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/edit/{{ $tt->id }}">Sửa</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection