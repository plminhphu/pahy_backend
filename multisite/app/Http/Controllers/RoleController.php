<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Danh sách Role
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('role.index', compact('roles'));
    }

    /**
     * Form tạo Role
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Lưu Role mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        // Nếu có permissions gửi kèm
        if ($request->has('permissions')) {
            foreach ($request->permissions as $module => $abilities) {
                Permission::create(array_merge($abilities, [
                    'role_id' => $role->id,
                    'module' => $module,
                ]));
            }
        }

        return redirect()->route('role.index')->with('success', 'Tạo role thành công');
    }

    /**
     * Hiển thị chi tiết Role
     */
    public function show(Role $role)
    {
        $role->load('permissions');
        return view('role.show', compact('role'));
    }

    /**
     * Form sửa Role
     */
    public function edit(Role $role)
    {
        $role->load('permissions');
        return view('role.edit', compact('role'));
    }

    /**
     * Cập nhật Role
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        // Xóa permission cũ, tạo lại
        $role->permissions()->delete();

        if ($request->has('permissions')) {
            foreach ($request->permissions as $module => $abilities) {
                Permission::create(array_merge($abilities, [
                    'role_id' => $role->id,
                    'module' => $module,
                ]));
            }
        }

        return redirect()->route('role.index')->with('success', 'Cập nhật role thành công');
    }

    /**
     * Xóa Role
     */
    public function destroy(Role $role)
    {
        $role->permissions()->delete();
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Xóa role thành công');
    }
}
