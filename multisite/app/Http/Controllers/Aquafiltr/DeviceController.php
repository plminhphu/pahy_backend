<?php

namespace App\Http\Controllers;

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
                    $query->where('name', 'like', "%$keywords%")
                          ->orWhere('serial_number', 'like', "%$keywords%")
                          ->orWhere('model', 'like', "%$keywords%")
                          ->orWhere('type', 'like', "%$keywords%")
                          ->orWhere('location', 'like', "%$keywords%")
                          ->orWhere('status', 'like', "%$keywords%")
                          ;
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'page', $page);
            return view('device.list', compact('devices'))->render();
        } else {
            $title = 'Danh sách thiết bị';
            return view('device.index', compact('title'));
        }
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        Device::create($validated);

        return response()->json(['message' => 'Thiết bị đã được tạo thành công'], 201);
    }

    public function show(Device $device)
    {
        return view('device.show', compact('device'));
    }

    public function edit(Device $device)
    {
        return view('device.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number,' . $device->id,
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $device->update($validated);

        return response()->json(['message' => 'Thiết bị đã được cập nhật thành công'], 202);
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return response()->json(['message' => 'Thiết bị đã được xóa thành công'], 202);
    }
}
