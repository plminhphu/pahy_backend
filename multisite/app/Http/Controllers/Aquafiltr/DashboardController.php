<?php

namespace App\Http\Controllers\Aquafiltr;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
      return view('aquafiltr.admin.index');
    }
}