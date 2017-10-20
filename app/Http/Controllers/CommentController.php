<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getDelete($id, $idTinTuc){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/edit/'.$idTinTuc)->with('thongbao', 'Xóa bình luận thành công.');
    }
}
