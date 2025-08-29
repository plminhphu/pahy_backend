<?php

namespace App\Http\Controllers\Aquafiltr;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Trang chủ'; $auth = 'Tuấn NA';
        return view('coming-soon', ['title' => $title, 'auth' => $auth]);
    }
}