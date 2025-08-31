<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // Áp dụng middleware permission cho từng action
        $this->middleware(function ($request, $next) {
            $action = $request->route()->getActionMethod();
            switch ($action) {
                case 'index':   $this->authorizePermission('user','getall'); break;
                case 'show':    $this->authorizePermission('user','getone'); break;
                case 'create':
                case 'store':   $this->authorizePermission('user','created'); break;
                case 'edit':
                case 'update':  $this->authorizePermission('user','updated'); break;
                case 'destroy': $this->authorizePermission('user','deleted'); break;
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->page) {
            // join với bảng roles để lấy tên vai trò
            // kèm tìm kiếm theo keywords và phân trang
            $keywords = $request->keywords ?? '';
            $page = $request->page ?? 1;
            $users = User::select('users.*', 'roles.name as role_name')
                ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->where(function($query) use ($keywords) {
                    if ($keywords) {
                        $query->where('users.name', 'like', "%$keywords%")
                              ->orWhere('users.email', 'like', "%$keywords%")
                              ->orWhere('roles.name', 'like', "%$keywords%");
                    }
                })
                ->orderBy('users.created_at', 'desc')
                ->paginate(10, ['*'], 'page', $page);
            return view('user.list', compact('users'))->render();
        } else {
            $title = 'Danh sách nhân viên';
            return view('user.index', compact('title'));
        }
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['code'] = 'U' . str_pad(User::max('id') + 1, 5, '0', STR_PAD_LEFT);
        
        User::create($validated);

        return response()->json(['message' => 'Tài khoản đã được tạo thành công'], 201);
    }

    public function show(User $user)
    {
        $user=User::select('users.*', 'roles.name as role_name')->leftJoin('roles', 'users.role_id', '=', 'roles.id')->where('users.id', $user->id)->first();
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json(['message' => 'Tài khoản đã được cập nhật thành công'], 202);
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return response()->json(['message' => 'Tài khoản đã được xóa thành công'], 202);
    }
}
