<?php

namespace App\Http\Controllers\Aquafiltr;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $auth='Tuấn NA';
        return view('coming-soon', ['auth'=>$auth]);
    }
}