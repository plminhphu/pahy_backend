<?php
namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit() {
        $title = 'Chỉnh sửa hồ sơ';
        $permissions = Permission::where('role_id', Auth::user()->role_id)->get();
        $role = Auth::user()->role;
        return view('profile.edit', compact('title', 'permissions', 'role'));
    }

    // uploadAvatar
    public function uploadAvatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = $request->user();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            // Lưu file vào thư mục public/images với tên file là user_{id}.{ext}
            $filename = 'user_' . $user->id . '.' . $file->getClientOriginalExtension();
            // chuyển ảnh sang webp
            
            $file->move(public_path('aquafiltr/images'), $filename);
            // Xóa avatar cũ nếu có
            if ($user->id && file_exists(public_path('images/' . basename($user->id)))) {
                unlink(public_path('aquafiltr/images/' . basename($user->id)));
            }
            User::where('id', $user->id)->update(['avatar'=>basename($filename),'updated_at'=>now()]);
            return response()->json(['message' => 'Đã tải ảnh đại diện thành công!', 'avatar' => asset('public/aquafiltr/images/' . basename($filename)).'?='.time()]);
        }
        return response()->json(['message' => 'Không có file hình được tải lên!'], 400);
    }

    public function update(Request $request) {
        // logic update
    }

    public function destroy() {
        // logic delete
    }

    public function password() {
        $title = 'Đổi mật khẩu';
        return view('profile.password', ['title' => $title]);
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
