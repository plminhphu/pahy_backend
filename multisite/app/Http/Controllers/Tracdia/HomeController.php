<?php

namespace App\Http\Controllers\Tracdia;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $auth='Quý Phạm';
        return view('coming-soon', ['auth'=>$auth]);
    }
    public function thuychuan()
    {
        $title = 'Chính sách bảo mật dữ liệu ứng dụng Thủy Chuẩn VN';
        return view('tracdia.home.chinhsach', ['title' => $title]);
    }
}