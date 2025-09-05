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

    public function scan($id = null)
    {
        $title = 'Tra cứu lịch hẹn';
        return view('aquafiltr.home.scan', compact('title', 'id'));
    }

    public function scanResult()
    {
        $code = request('code', '');
        if (!$code) {
            return 'Chưa nhập mã tra cứu';
        }
        // tìm trong bảng appointments
        $appointment = \App\Models\Appointment::where('code', $code)->first();
        if (!$appointment) {
            return 'Mã tra cứu không tồn tại';
        }
        // trả về thông tin lịch hẹn
        return view('aquafiltr.admin.appointment.show', compact('appointment'));
    }
}