<?php
namespace App\Http\Controllers\Aquafiltr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Customer;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Response;
class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $action = $request->route()->getActionMethod();
            switch ($action) {
                case 'index':
                    $this->authorizePermission('appointment', 'getall');
                    break;
                case 'show':
                    $this->authorizePermission('appointment', 'getone');
                    break;
                case 'create':
                case 'store':
                    $this->authorizePermission('appointment', 'created');
                    break;
                case 'edit':
                case 'update':
                    $this->authorizePermission('appointment', 'updated');
                    break;
                case 'destroy':
                    $this->authorizePermission('appointment', 'deleted');
                    break;
            }
            return $next($request);
        });
    }
    // Hiển thị danh sách lịch hẹn
    public function index()
    {
        if (request()->ajax() || request()->page) {
        $keywords = request('keywords', '');
            $page = request('page', 1);
            $appointments = Appointment::where(function ($query) use ($keywords) {
                if ($keywords) {
                    $query->where('customer_name', 'like', "%$keywords%")
                        ->orWhere('phone', 'like', "%$keywords%")
                        ->orWhere('address', 'like', "%$keywords%")
                        ->orWhere('product_type', 'like', "%$keywords%");
                }
            })->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $page);
            return view('aquafiltr.admin.appointment.list', compact('appointments'))->render();
        } else {
            $customers = Customer::all();
            $title = 'Quản lý lịch hẹn';
            return view('aquafiltr.admin.appointment.index', compact('title','customers'));
        }
    }

    // Form tạo mới
    public function create()
    {
        $customers = Customer::all();
        return view('aquafiltr.admin.appointment.create', ['customers' => $customers]);
    }

    // Lưu lịch hẹn mới
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'product_type' => 'required',
            'appointment_date' => 'required|date',
        ]);

        $last = Appointment::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $customerCode = 'AP' . str_pad($nextId, 8, '0', STR_PAD_LEFT);

        $appointment = Appointment::create([
            'code'   => $customerCode,
            'customer_name'   => $request->customer_name,
            'phone'           => $request->phone,
            'address'         => $request->address,
            'region'          => $request->region,
            'product_type'    => $request->product_type,
            'service'         => $request->service,
            'appointment_date' => $request->appointment_date,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return response()->json(['message' => 'Lịch hẹn đã được tạo thành công', 'id' => $appointment->id], 201);
    }

    // Xem chi tiết lịch hẹn
    public function show($id)
    {
    $appointment = Appointment::find($id);
    return view('aquafiltr.admin.appointment.show', compact('appointment'));
    $appointment = Appointment::find($id);
    return view('aquafiltr.admin.appointment.edit', compact('appointment'));
        $appointment = Appointment::find($id);
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'product_type' => 'required',
            'appointment_date' => 'required|date',
        ]);
        $appointment->update($request->only([
            'customer_name', 'phone', 'address', 'region', 'product_type', 'service', 'appointment_date'
        ]));
        return response()->json(['message' => 'Lịch hẹn đã được cập nhật thành công'], 202);
    $appointment = Appointment::find($id);
    $appointment->delete();
    return response()->json(['message' => 'Lịch hẹn đã được xóa thành công'], 202);
    }

    // Xuất hóa đơn PDF
    public function invoice($id)
    {
        $appointment = Appointment::find($id);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('aquafiltr.admin.appointment.invoice', ['appointment' => $appointment]);
        return $pdf->download("invoice_{$appointment->code}.pdf");
    }

    // In mã vạch (barcode)
    public function barcode($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment === null) {
            return response()->json(['message' => 'Lịch hẹn không tồn tại'], 404);
        }
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode(
            strval($appointment->code), 
            $generator::TYPE_CODE_128, // kiểu barcode
            5, // độ rộng
            60 // chiều cao
        );
        return Response::make($barcode, 200, [
            'Content-Type' => 'image/png',
        ]);
    }

}
