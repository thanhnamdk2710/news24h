<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;

class TinTucController extends Controller
{
    public function getList(){
        $tintuc = TinTuc::orderBy('id', 'DESC')->get();
        return view('admin.tintuc.list', ['tintuc'=>$tintuc]);
    }

    public function getAdd(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.add', ['theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }
    public function postAdd(Request $request){
        $this->validate($request, [
            'TheLoai'=>'required',
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
        ],[
            'TheLoai.required'=>'Bạn chưa chọn Thể loại',
            'LoaiTin.required'=>'Bạn chưa chọn Loại tin',
            'TieuDe.required'=>'Bạn chưa nhập Tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Bạn chưa nhập Tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập Nội dung'
        ]);

        $tintuc = new TinTuc();
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;


        if ($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/tintuc/add')->with('loi', 'Bạn chỉ được chọn file JPG, PNG, JPEG.');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc/",$Hinh);
            $tintuc->Hinh = $Hinh;

        } else {
            $tintuc->Hinh = "";
        }

        $tintuc->save();

        return redirect('admin/tintuc/add')->with('thongbao', 'Thêm tin thành công.');
    }

    public function getEdit($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.edit', ['tintuc'=>$tintuc, 'theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }
    public function postEdit(Request $request, $id){
        $tintuc = TinTuc::find($id);
        $this->validate($request, [
            'TheLoai'=>'required',
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
        ],[
            'TheLoai.required'=>'Bạn chưa chọn Thể loại',
            'LoaiTin.required'=>'Bạn chưa chọn Loại tin',
            'TieuDe.required'=>'Bạn chưa nhập Tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Bạn chưa nhập Tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập Nội dung'
        ]);

        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;


        if ($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/tintuc/add')->with('loi', 'Bạn chỉ được chọn file JPG, PNG, JPEG.');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc/",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;

        }

        $tintuc->save();

        return redirect('admin/tintuc/edit/'.$id)->with('thongbao', 'Sửa tin thành công.');

    }

    public function getDelete($id){
        $tintuc = TinTuc::find($id);
        $tintuc->comment()->delete();
        $tintuc->delete();

        return redirect('admin/tintuc/list')->with('thongbao','Xóa thành công.');
    }

}
