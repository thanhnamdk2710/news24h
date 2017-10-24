<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Support\Facades\Auth;
use App\User;

class PageController extends Controller
{
    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai', $theloai);
        view()->share('slide', $slide);
    }

    function trangchu(){
        return view('pages.trangchu');
    }

    function lienhe(){
        return view('pages.lienhe');
    }

    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }

    function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat', 1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc', ['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan]);
    }

    function getLogin(){
        return view('pages.login');
    }

    function postLogin(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:3|max:32'
        ], [
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
        ]);

        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('/');
        } else {
            return redirect('login')->with('loi', 'Đăng nhập không thành công.');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('/login');
    }

    public function getSignin(){
        return view('pages.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:32',
            're_password' => 'required|same:password'
        ], [
            'name.required' => 'Bạn chưa nhập tài khoản',
            'name.min' => 'Tên tài khoản phải có ít nhất 3 ký tự',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
            're_password.required' => 'Bạn chưa nhập lại mật khẩu',
            're_password.same' => ' Mật khẩu nhập lại không khớp'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;

        $user->save();

    return redirect('/login')->with('thongbao', 'Đăng ký thành công');
    }

    public function getUser(){
        $user = Auth::user();
        return view('pages.user')->with('user', $user);
    }
    public function postUser(Request $request, $id){
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required|min:3',
            'password' => 'required|min:3|max:32',
            're_password' => 'required|same:password'
        ], [
            'name.required' => 'Bạn chưa nhập tài khoản',
            'name.min' => 'Tên tài khoản phải có ít nhất 3 ký tự',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
            're_password.required' => 'Bạn chưa nhập lại mật khẩu',
            're_password.same' => ' Mật khẩu nhập lại không khớp'
        ]);

        $user->name = $request->name;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect('user')->with('thongbao', 'Chỉnh sửa thành công');
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        $tintuc = TinTuc::where('TieuDe', 'like', "%$keyword%")
            ->orWhere('TomTat', 'like', "%$keyword%")
            ->orWhere('NoiDung', 'like', "%$keyword%")
            ->take(30)->paginate(5);
        return view('pages.search', ['tintuc'=>$tintuc, 'keyword'=>$keyword]);
    }
}
