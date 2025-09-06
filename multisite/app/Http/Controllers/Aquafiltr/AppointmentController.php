<?php
namespace App\Http\Controllers\Aquafiltr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
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
                case 'check':
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
                        ->orWhere('customer_phone', 'like', "%$keywords%")
                        ->orWhere('customer_address', 'like', "%$keywords%")
                        ->orWhere('device_code', 'like', "%$keywords%")
                        ->orWhere('device_name', 'like', "%$keywords%");
                }
            })->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $page);
            return view('aquafiltr.admin.appointment.list', compact('appointments'))->render();
        } else {
            $title = 'Quản lý lịch hẹn';
            return view('aquafiltr.admin.appointment.index', compact('title'));
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
            'device_price' => 'nullable|numeric',
            'device_info' => 'nullable|string|max:255',
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

    // Form sửa lịch hẹn
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $customers = \App\Models\Customer::all();
        $devices = \App\Models\Device::all();
        return view('aquafiltr.admin.appointment.edit', compact('appointment', 'customers', 'devices'));
    }

    // Cập nhật lịch hẹn không được tạo mới và thay đoi khách hàng, không đc thay đổi mã code
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_address' => 'required|string|max:255',
            'customer_region' => 'nullable|string|max:50',
            'device_id' => 'nullable|string|max:100',
            'device_code' => 'nullable|string|max:20',
            'device_name' => 'nullable|string|max:100',
            'device_model' => 'nullable|string|max:50',
            'device_price' => 'nullable|numeric',
            'device_info' => 'nullable|string|max:255',
            'device_imei' => 'nullable|string|max:50',
            'appointment_date' => 'required|date',
            'reminder_cycle' => 'nullable|integer',
            'note' => 'nullable|string',
        ]);
        $data = $request->only([
            'customer_name', 'customer_address', 'customer_region',
            'device_id', 'device_code', 'device_name', 'device_model', 'device_imei',
            'appointment_date', 'reminder_cycle', 'note'
        ]);
        $appointment->update($data);
        return response()->json(['message' => 'Lịch hẹn đã được cập nhật thành công'], 201);
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
    public function invoice($id, $type = 'preview')
    {
        $appointment = Appointment::find($id);
        // lấy thông tin user qua $appointment->user_id
        $user = User::find($appointment->user_id);
        if ($type === 'preview' || $type === 'download') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('aquafiltr.admin.appointment.invoice', ['appointment' => $appointment, 'user' => $user]);
            $pdf->addInfo([
                'Title' => "Service Invoice - Appointment Schedule {$appointment->code}",
                'Author' => 'Aquafiltr Shop - plminhphu.vn',
                'Subject' => "Service Invoice - Appointment Schedule {$appointment->code}",
                'Keywords' => 'Service,Invoice,Aquafiltr,Appointment,Schedule'
            ]);
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'DejaVu Sans']);
            $pdf->setWarnings(false);
            if ($type === 'download'){
                return $pdf->download("invoice_{$appointment->code}.pdf");
            }else{
                return $pdf->stream("invoice_{$appointment->code}.pdf");
            }
        }else {
            return view('aquafiltr.admin.appointment.invoice', ['appointment' => $appointment, 'user' => $user]);
        }
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

    /* Xóa lịch hẹn */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return response()->json(['message' => 'Lịch hẹn đã được xóa thành công'], 202);
    }

    /* cron job gửi nhắc lịch hẹn */
    public function sendReminders()
    {
        $today = date('Y-m-d');
        $appointments = Appointment::where('reminder_cycle', '>', 0)
            ->whereDate('appointment_date', '>=', $today)
            ->get();
        foreach ($appointments as $appointment) {
            $reminderDate = date('Y-m-d', strtotime($appointment->appointment_date . " -{$appointment->reminder_cycle} days"));
            if ($reminderDate == $today) {
                // kiểm tra đã gửi nhắc chưa
                $existingReminder = \App\Models\Reminder::where('appointment_id', $appointment->id)
                    ->whereDate('reminder_date', $today)
                    ->first();
                if ($existingReminder) {
                    continue; // đã gửi nhắc rồi, bỏ qua lịch hẹn này
                } else {
                    // gửi tin nhắn nhắc lịch hẹn
                    $message = "Nhắc lịch hẹn: Quý khách {$appointment->customer_name}, mã lịch hẹn {$appointment->code} vào ngày " . date('d/m/Y H:i', strtotime($appointment->appointment_date)) . ". Cảm ơn quý khách!";

                    // gửi email nhắc lịch hẹn
                    try {
                        Mail::send([], [], function ($mail) use ($appointment, $message) {
                            $mail->to($appointment->customer_email ?? '@yourdomain.com')
                                ->subject('Nhắc lịch hẹn')
                                ->setBody($message, 'text/html');
                        });
                        $sent = 1;
                    } catch (\Exception $e) {
                        $sent = 0;
                    }

                    // lưu vào bảng reminders
                    \App\Models\Reminder::create([
                        'appointment_id' => $appointment->id,
                        'reminder_date' => $today,
                        'sent' => $sent,
                    ]);
                }
            }
        }
    }

    // danh sách lịch hẹn hôm nay, giống index nhưng chỉ hiện lịch hẹn ngày hiện tại
    function checkin()
    {
        if (request()->ajax()) {
            // nếu không có request date thì chọn hôm nay
            $date = request('date', date('Y-m-d'));
            $tomorow = date('Y-m-d', strtotime($date . ' +1 day'));
            $appointments = Appointment::whereDate('appointment_date', $date)
                ->orWhereDate('appointment_date', $tomorow)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('aquafiltr.admin.appointment.checklist', compact('appointments'));
        } else {
            $title = 'Kiểm tra lịch hẹn hôm nay';
            return view('aquafiltr.admin.appointment.check', compact('title'));
        }
    }

    // thay đổi trạng thái hoàn thành lịch hẹn
    public function status(Request $request)
    {
        // kiểm tra ajax
        if (!request()->ajax()) {
            abort(403, 'Chỉ chấp nhận yêu cầu AJAX');
        }
        // validate
        $request->validate([
            'id' => 'required|exists:appointments,id',
            'status' => 'required|boolean',
        ]);
        $appointment = Appointment::find($request->id);
        $appointment->status = $request->status;
        $appointment->save();
        return response()->json(['message' => $request->status? 'Đã xác nhận lịch hẹn' : ' Đã bỏ xác nhận lịch hẹn'], 201);
    }
}
