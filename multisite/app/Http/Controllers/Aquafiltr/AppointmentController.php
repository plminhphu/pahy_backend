<?php

namespace App\Http\Controllers\Aquafiltr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Response;

class AppointmentController extends Controller
{
    // Hiển thị danh sách lịch hẹn
    public function index()
    {
        $appointments = Appointment::orderBy('id', 'desc')->paginate(10);
        return view('aquafiltr.admin.appointments.index', compact('appointments'));
    }

    // Form tạo mới
    public function create()
    {
        return view('aquafiltr.admin.appointments.create');
    }

    // Lưu lịch hẹn mới
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'product_type' => 'required',
            'sale_date' => 'required|date',
            'appointment_date' => 'required|date',
        ]);

        // Sinh mã khách hàng tự động KH000X
        $last = Appointment::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $customerCode = 'KH' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $id = Appointment::insertGetId([
            'customer_code'   => $customerCode,
            'customer_name'   => $request->customer_name,
            'phone'           => $request->phone,
            'address'         => $request->address,
            'region'          => $request->region,
            'product_type'    => $request->product_type,
            'service'         => $request->service,
            'sale_date'       => $request->sale_date,
            'appointment_date'=> $request->appointment_date,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->route('aquafiltr.admin.appointments.show', $id)
                         ->with('success', 'Lịch hẹn đã được tạo thành công.');
    }

    // Xem chi tiết lịch hẹn
    public function show($id)
    {
        $appointment = Appointment::find($id);
        return view('aquafiltr.admin.appointments.show', compact('appointment'));
    }

    // Xuất hóa đơn PDF
    public function invoice($id)
    {
        $appointment = Appointment::find($id);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('appointments.invoice', compact('appointment'));
        return $pdf->download("invoice_{$appointment->customer_code}.pdf");
    }

    // In mã vạch (barcode)
    public function barcode($id)
    {
        $appointment = Appointment::find($id);

        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($appointment->customer_code, $generator::TYPE_CODE_128);

        return Response::make($barcode, 200, ['Content-Type' => 'image/png']);
    }
}