<?php

namespace App\Http\Controllers\Phuvn;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $auth='PL Minh Phú';
        return view('coming-soon', ['auth'=>$auth]);
    }
}