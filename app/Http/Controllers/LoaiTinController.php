<?php

namespace App\Http\Controllers;

use App\LoaiTin;
use Illuminate\Http\Request;
use App\TheLoai;

class LoaiTinController extends Controller
{
    public function getList(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.list', ['loaitin'=>$loaitin]);
    }

    public function getAdd(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.add', ['theloai'=>$theloai]);
    }
    public function postAdd(Request $request){
        $this->validate($request,
            [
                'Ten'       => 'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'   => 'required'
            ],[
                'Ten.required'      => 'Bạn chưa nhập Tên loại tin',
                'Ten.unique'        => 'Tên loại tin đã tồn tại',
                'Ten.min'           => 'Tên loại tin phải có từ 3 đến 100 ký tự',
                'Ten.max'           => 'Tên loại tin phải có từ 3 đến 100 ký tự',
                'TheLoai.required'  => 'Bạn chưa chọn Thể loại',
            ]);

        $loaitin = new LoaiTin();
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;

        $loaitin->save();

        return redirect('admin/loaitin/add')->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id){
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin.loaitin.edit', ['loaitin'=>$loaitin, 'theloai'=>$theloai]);
    }
    public function postEdit(Request $request, $id){
        $loaitin = LoaiTin::find($id);
        $this->validate($request,
            [
                'Ten'       => 'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'   => 'required'
            ],[
                'Ten.required'      => 'Bạn chưa nhập Tên loại tin',
                'Ten.unique'        => 'Tên loại tin đã tồn tại',
                'Ten.min'           => 'Tên loại tin phải có từ 3 đến 100 ký tự',
                'Ten.max'           => 'Tên loại tin phải có từ 3 đến 100 ký tự',
                'TheLoai.required'  => 'Bạn chưa chọn Thể loại',
            ]);

        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;

        $loaitin->save();

        return redirect('admin/loaitin/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }

    public function getDelete($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/list')->with('thongbao', 'Xóa thành công.');
    }
}
