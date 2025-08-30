<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Danh sách quyền
     */
    public function index()
    {
        $permissions = Permission::with('role')->get();
        return view('permission.index', compact('permissions'));
    }

    /**
     * Form tạo quyền
     */
    public function create()
    {
        $roles = Role::all();
        return view('permission.create', compact('roles'));
    }

    /**
     * Lưu quyền mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'module' => 'required|string',
            'gets' => 'boolean',
            'get' => 'boolean',
            'create' => 'boolean',
            'update' => 'boolean',
            'delete' => 'boolean',
        ]);

        Permission::create([
            'role_id' => $request->role_id,
            'module' => $request->module,
            'gets' => $request->boolean('gets'),
            'get' => $request->boolean('get'),
            'create' => $request->boolean('create'),
            'update' => $request->boolean('update'),
            'delete' => $request->boolean('delete'),
        ]);

        return redirect()->route('permission.index')->with('success', 'Tạo permission thành công');
    }

    /**
     * Hiển thị chi tiết
     */
    public function show(Permission $permission)
    {
        return view('permission.show', compact('permission'));
    }

    /**
     * Form sửa quyền
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('permission.edit', compact('permission', 'roles'));
    }

    /**
     * Cập nhật quyền
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'module' => 'required|string',
            'gets' => 'boolean',
            'get' => 'boolean',
            'create' => 'boolean',
            'update' => 'boolean',
            'delete' => 'boolean',
        ]);

        $permission->update([
            'role_id' => $request->role_id,
            'module' => $request->module,
            'gets' => $request->boolean('gets'),
            'get' => $request->boolean('get'),
            'create' => $request->boolean('create'),
            'update' => $request->boolean('update'),
            'delete' => $request->boolean('delete'),
        ]);

        return redirect()->route('permission.index')->with('success', 'Cập nhật permission thành công');
    }

    /**
     * Xóa quyền
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permission.index')->with('success', 'Xóa permission thành công');
    }
}
