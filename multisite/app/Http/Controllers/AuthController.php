<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Hiển thị form login
    public function showLogin()
    {
        $title = 'Đăng nhập hệ thống';
        return view('auth.login', ['title' => $title]);
    }
    public function handleLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return response()->json(['redirect' => route('dashboard')]);
        }

        return response()->json(['message' => 'Email hoặc mật khẩu không đúng!'], 401);
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // chuyển đến route login
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }

    // Hiển thị form quên mật khẩu
    public function showForgotPassword()
    {
        $title = 'Quên mật khẩu';
        return view('auth.forgot-password', ['title' => $title]);
    }

    // Gửi link reset mật khẩu
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
