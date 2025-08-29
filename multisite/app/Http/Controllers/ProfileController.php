<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // logic update password
    }
}
