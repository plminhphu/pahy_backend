<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    
    public function __construct()
    {
        // Áp dụng middleware permission cho từng action
        $this->middleware(function ($request, $next) {
            $action = $request->route()->getActionMethod();
            switch ($action) {
                case 'index':   $this->authorizePermission('role','getall'); break;
                case 'show':    $this->authorizePermission('role','getone'); break;
                case 'create':
                case 'store':   $this->authorizePermission('role','created'); break;
                case 'edit':
                case 'update':  $this->authorizePermission('role','updated'); break;
                case 'destroy': $this->authorizePermission('role','deleted'); break;
            }
            return $next($request);
        });
    }

    /**
     * Danh sách Role
     */
    public function index(Request $request)
    {
        if ($request->page) {
            $keywords = $request->keywords ?? '';
            $page = $request->page ?? 1;
            $roles = Role::with('permissions')
                ->where(function($query) use ($keywords) {
                    if ($keywords) {
                        $query->where('roles.name', 'like', "%$keywords%");
                    }
                })
                ->orderBy('roles.created_at', 'desc')
                ->paginate(10, ['*'], 'page', $page);
            return view('role.list', compact('roles'))->render();
        } else {
            $title = 'Danh sách nhân viên';
            return view('role.index', compact('title'));
        }
    }

    /**
     * Form tạo Role
     */
    public function create()
    {
        if (!request()->ajax()) {
            abort(403, 'Chỉ chấp nhận yêu cầu AJAX');
        }
        return view('role.create');
    }

    /**
     * Lưu Role mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'title' => 'required|string|max:255',
        ]);

        Role::create([
            'name' => $request->name,
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'Phân quyền đã được tạo thành công'], 201);
    }

    /**
     * Hiển thị chi tiết Role
     */
    public function show(Role $role)
    {
        if (!request()->ajax()) {
            abort(403, 'Chỉ chấp nhận yêu cầu AJAX');
        }
        $role->load('permissions');
        return view('role.show', compact('role'));
    }

    /**
     * Form sửa Role
     */
    public function edit(Role $role)
    {
        if (!request()->ajax()) {
            abort(403, 'Chỉ chấp nhận yêu cầu AJAX');
        }
        $role = Role::with('permissions')->find($role->id);
        $permissions = DB::table('permissions')->select('name', 'title')->distinct('name')->get();
        return view('role.edit', compact('role', 'permissions'));
    }

    /**
     * Cập nhật Role
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'title' => 'required|string|max:255',
        ]);

        $role->update($data);
        $permissions = DB::table('permissions')->select('name', 'title')->distinct('name')->get();
        foreach ($permissions as $permission) {
            $isset = Permission::where('role_id', $role->id)->where('name', $permission->name)->first()??false;
            if ($isset==false) {
                Permission::create([    
                    'role_id' => $role->id,
                    'name' => $permission->name,
                    'title' => $permission->title,
                ]);
                // delay 300ms
                usleep(500000);
            }
            foreach (['getall', 'getone', 'created', 'updated', 'deleted'] as $action) {
                $value = $request->input($permission->name . '.' . $action, 0);
                Permission::where('role_id', $role->id)
                    ->where('name', $permission->name)
                    ->update([$action => $value]);
            }
        }
        return response()->json(['message' => 'Cập nhật phân quyền thành công'], 202);
    }

    /**
     * Xóa Role
     */
    public function destroy(Role $role)
    {
        $role->permissions()->delete();
        $role->delete();

        return response()->json(['message' => 'Xóa phân quyền thành công'],202);
    }
}
