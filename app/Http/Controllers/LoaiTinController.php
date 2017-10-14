<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoaiTinController extends Controller
{
    public function getList(){
        return view('admin.loaitin.list');
    }

    public function getAdd(){
        return view();
    }

    public function getEdit(){
        return view();
    }
}
