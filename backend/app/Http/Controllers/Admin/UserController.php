<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(['id', 'name', 'email']);
        return response()->json([
            'count' => $users->count(),
            'data' => $users,
        ]);
    }
}
