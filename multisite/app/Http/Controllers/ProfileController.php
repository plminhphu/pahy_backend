<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit() {
        return view('profile.edit');
    }

    public function update(Request $request) {
        // logic update
    }

    public function destroy() {
        // logic delete
    }

    public function password() {
        return view('profile.password');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = $request->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Mật khẩu hiện tại không đúng!'], 422);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json(['message' => 'Đổi mật khẩu thành công!']);
    }
}
