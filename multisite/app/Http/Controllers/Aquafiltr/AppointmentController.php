<?php
namespace App\Http\Controllers\Aquafiltr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
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
            $title = 'Quản lý lịch hẹn';
            $customers = \App\Models\Customer::all();
            $devices = \App\Models\Device::all();
            return view('aquafiltr.admin.appointment.index', compact('title', 'customers', 'devices'));
        }
    }

    // Form tạo mới
    public function create()
    {
        $customers = \App\Models\Customer::all();
        $devices = \App\Models\Device::all();
        return view('aquafiltr.admin.appointment.create', ['customers' => $customers, 'devices' => $devices]);
    }

    // Đặt lịch hẹn mới
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'nullable|string|max:100',
            'customer_code' => 'nullable|string|max:20',
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:15',
            'customer_address' => 'required|string|max:255',
            'customer_region' => 'nullable|string|max:50',
            'device_id' => 'nullable|string|max:100',
            'device_code' => 'nullable|string|max:20',
            'device_name' => 'nullable|string|max:100',
            'device_model' => 'nullable|string|max:50',
            'device_imei' => 'nullable|string|max:50',
            'appointment_date' => 'required|date',
            'reminder_cycle' => 'nullable|integer',
            'note' => 'nullable|string',
        ]);
        // đưa customer_phone về dạng chỉ có số, bỏ dấu cách, dấu chấm, dấu gạch ngang
        $data['customer_phone'] = preg_replace('/[^\d]/', '', $data['customer_phone']);
        // Tạo mã code tự động
        $last = Appointment::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $customerCode = 'AP' . str_pad($nextId, 8, '0', STR_PAD_LEFT);
        // thêm user_id
        $data['user_id'] = Auth::user()->id;
        // kiểm tra nếu chọn từ khách hàng có sẵn bằng số điện thoại
        $customer = \App\Models\Customer::where('phone',$data['customer_phone'])->first()??null;
        if ($customer!==null) {
            $data['customer_id'] = $customer->id;
            $data['customer_code'] = $customer->code;
            $data['customer_name'] = $customer->name;
            $data['customer_phone'] = $customer->phone;
            $data['customer_address'] = $customer->address;
            $data['customer_region'] = $customer->region;
        }else {
            // tạo mới khách hàng
            $newCustomer = \App\Models\Customer::create([
                'code' => 'CU' . str_pad(\App\Models\Customer::count() + 1, 8, '0', STR_PAD_LEFT),
                'name' => $data['customer_name'],
                'phone' => $data['customer_phone'],
                'address' => $data['customer_address'],
                'region' => $data['customer_region'] ?? '',
                'user_id' => Auth::user()->id,
            ]);
            $data['customer_id'] = $newCustomer->id;
            $data['customer_code'] = $newCustomer->code;
        }

        $appointment = Appointment::create(array_merge($data, ['code' => $customerCode]));
        
        if ($appointment) {
            return response()->json(['message' => 'Lịch hẹn đã được tạo thành công'], 201);
        }else {
            return response()->json(['message' => 'Đã có lỗi xảy ra, vui lòng thử lại'], 500);
        }
    }

    // Xem chi tiết lịch hẹn
    public function show($id)
    {

        if (!request()->ajax()) {
            abort(403, 'Chỉ chấp nhận yêu cầu AJAX');
        }
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
