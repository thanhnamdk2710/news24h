<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TinTuc;

class CommentController extends Controller
{
    public function getDelete($id, $idTinTuc){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/edit/'.$idTinTuc)->with('thongbao', 'Xóa bình luận thành công.');
    }

    public function postComment(Request $request, $id){
        $idTinTuc = $id;
        $tintuc = TinTuc::find($id);
        $comment = new Comment();
        $comment->idTinTuc = $idTinTuc;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;
        $comment->save();

        return redirect("/tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao', 'Viết binh luận thành công.');
    }
}
