<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
    public function getList(){
        return view('admin.theloai.list');
    }

    public function getAdd(){
        return view();
    }

    public function getEdit(){
        return view();
    }
}
