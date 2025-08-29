<?php

namespace App\Http\Controllers\Aquafiltr;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
      $title = 'Dashboard';
      return view('aquafiltr.admin.index', ['title' => $title]);
    }
}