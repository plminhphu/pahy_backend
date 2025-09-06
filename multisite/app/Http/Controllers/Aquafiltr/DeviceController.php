<?php
namespace App\Http\Controllers\Aquafiltr;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function __construct()
    {
        // Áp dụng middleware permission cho từng action
        $this->middleware(function ($request, $next) {
            $action = $request->route()->getActionMethod();
            switch ($action) {
                case 'index':   $this->authorizePermission('device','getall'); break;
                case 'show':    $this->authorizePermission('device','getone'); break;
                case 'create':
                case 'store':   $this->authorizePermission('device','created'); break;
                case 'edit':
                case 'update':  $this->authorizePermission('device','updated'); break;
                case 'destroy': $this->authorizePermission('device','deleted'); break;
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->page) {
            $keywords = $request->keywords ?? '';
            $page = $request->page ?? 1;
            $devices = Device::where(function($query) use ($keywords) {
                if ($keywords) {
                    $query->where('code', 'like', "%$keywords%")
                          ->orWhere('name', 'like', "%$keywords%")
                          ->orWhere('model', 'like', "%$keywords%");
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'page', $page);
            return view('aquafiltr.admin.device.list', compact('devices'))->render();
        } else {
            $title = 'Danh sách thiết bị';
            return view('aquafiltr.admin.device.index', compact('title'));
        }
    }

    public function create()
    {
        if (!request()->ajax()) {
            abort(403, 'Chỉ chấp nhận yêu cầu AJAX');
        }
        return view('aquafiltr.admin.device.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:250',
            'model' => 'required|string|max:250',
            'price' => 'nullable|numeric',
            'info'  => 'nullable|string|max:500',
        ]);

        // Tạo code tự động bằng tiền tố "DV" và id bốn số +1
        $validated['code'] = 'DV' . str_pad(Device::max('id') + 1, 5, '0', STR_PAD_LEFT);

        Device::create($validated);

        return response()->json(['message' => 'Thiết bị đã được tạo thành công'], 201);
    }

    public function show(Device $device)
    {
        if (!request()->ajax()) {
            abort(403, 'Chỉ chấp nhận yêu cầu AJAX');
        }
        return view('aquafiltr.admin.device.show', compact('device'));
    }

    public function info($id)
    {
        $device=Device::select(['id','name','code','model'])->where('devices.id', $id)->first();
        if (!$device) {
            return response()->json(['message' => 'Thiết bị không tồn tại'], 404);
        }
        return response()->json($device, 200);
    }

    public function edit(Device $device)
    {
        if (!request()->ajax()) {
            abort(403, 'Chỉ chấp nhận yêu cầu AJAX');
        }
        return view('aquafiltr.admin.device.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:250',
            'model' => 'required|string|max:250',
            'price' => 'nullable|numeric',
            'info'  => 'nullable|string|max:500',
        ]);

        $device->update($validated);

        return response()->json(['message' => 'Thiết bị đã được cập nhật thành công'], 202);
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return response()->json(['message' => 'Thiết bị đã được xóa thành công'], 202);
    }

    public function upload(Request $request)
    {
        $deviceId = $request->route('id');
        $device = Device::findOrFail($deviceId);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'device_' . $device->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('aquafiltr/images'), $imageName);

            // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
            Device::where('id', $deviceId)->update(['image'=>basename($imageName)]);

            return response()->json(['message' => 'Ảnh thiết bị đã được cập nhật thành công', 'image' => asset('public/aquafiltr/images/' . basename($imageName)).'?='.time()], 202);
        }

        return response()->json(['message' => 'Không có ảnh nào được tải lên'], 400);
    }
}
