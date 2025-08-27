<?php

namespace App\Http\Controllers\Aquafiltr\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Customer;
use Picqer\Barcode\BarcodeGeneratorPNG;

class AppointmentController extends Controller
{
    // Lấy danh sách lịch hẹn
    public function index()
    {
        $appointments = Appointment::with('customer')->orderBy('appointment_at','desc')->get();
        return response()->json($appointments);
    }

    // Xem chi tiết lịch hẹn
    public function show($id)
    {
        $appointment = Appointment::with('customer')->findOrFail($id);
        return response()->json($appointment);
    }

    // Tạo mới lịch hẹn
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'appointment_at' => 'required|date',
            'device_code' => 'nullable|string'
        ]);

        // Sinh mã khách hàng
        $customer_code = $this->generateCustomerCode();

        // Tạo khách hàng
        $customer = Customer::create([
            'customer_code' => $customer_code,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'product_type' => $request->device_code ?? null,
            'sale_date' => now()->toDateString()
        ]);

        // Tạo lịch hẹn
        $appointment = Appointment::create([
            'customer_id' => $customer->id,
            'appointment_at' => $request->appointment_at
        ]);

        // Sinh barcode
        $this->generateBarcode($customer->customer_code);

        return response()->json([
            'message' => 'Tạo lịch hẹn thành công',
            'appointment' => $appointment,
            'customer_code' => $customer_code
        ]);
    }

    // Cập nhật lịch hẹn
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'appointment_at' => 'required|date',
            'status' => 'nullable|in:pending,completed,cancelled'
        ]);

        $appointment->update([
            'appointment_at' => $request->appointment_at,
            'status' => $request->status ?? $appointment->status
        ]);

        return response()->json([
            'message' => 'Cập nhật lịch hẹn thành công',
            'appointment' => $appointment
        ]);
    }

    // Xóa lịch hẹn
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json([
            'message' => 'Xóa lịch hẹn thành công'
        ]);
    }

    // -----------------------------
    // Hàm sinh mã khách hàng tự tăng
    // -----------------------------
    private function generateCustomerCode()
    {
        $lastCustomer = Customer::orderBy('id','desc')->first();
        if(!$lastCustomer){
            return 'KH0001';
        }
        $lastNumber = intval(substr($lastCustomer->customer_code,2));
        $newNumber = $lastNumber + 1;
        return 'KH' . str_pad($newNumber,4,'0',STR_PAD_LEFT);
    }

    // -----------------------------
    // Hàm sinh barcode và lưu public/barcodes
    // -----------------------------
    private function generateBarcode($customer_code)
    {
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($customer_code, $generator::TYPE_CODE_128);

        $path = public_path('barcodes');
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }

        file_put_contents($path.'/'.$customer_code.'.png', $barcode);
    }
}
