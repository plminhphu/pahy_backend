<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function authorizePermission($table, $ability)
    {
        $role_id = Auth::user()->role_id ?? abort(403, 'Không có vai trò hợp lệ');
        $permission = Permission::where('name',$table)->where('role_id', $role_id)->first()?? abort(403, 'Không có quyền hạn hợp lệ');
        if (!$permission->$ability) {
            abort(403, 'Không có quyền truy cập');
        }
    }
}
