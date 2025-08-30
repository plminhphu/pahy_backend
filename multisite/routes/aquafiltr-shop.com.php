<?php
use Illuminate\Support\Facades\Route;

// Domain aquafiltr-shop.com
Route::domain('aquafiltr-shop.com')->group(function () {
    Route::get('/', [App\Http\Controllers\Aquafiltr\HomeController::class, 'index']);
    // Phần admin
    Route::prefix('/admin')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('/auth/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

            // nhóm dashboard
            Route::get('/', [App\Http\Controllers\Aquafiltr\DashboardController::class, 'index'])->name('admin');
            Route::get('/dashboard', [App\Http\Controllers\Aquafiltr\DashboardController::class, 'index'])->name('dashboard');
            // nhóm hồ sơ
            Route::prefix('/profile')->group(function () {
                Route::get('/', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
                Route::post('/', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
                Route::get('/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('password.edit');
                Route::post('/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
                Route::put('/avatar', [App\Http\Controllers\ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
            });
            // nhóm lịch hẹn
            Route::resource('appointment', App\Http\Controllers\Aquafiltr\AppointmentController::class);
            Route::get('appointment/{id}/invoice', [App\Http\Controllers\Aquafiltr\AppointmentController::class, 'invoice'])->name('appointment.invoice');
            Route::get('appointment/{id}/barcode', [App\Http\Controllers\Aquafiltr\AppointmentController::class, 'barcode'])->name('appointment.barcode');
            // nhóm khách hàng
            Route::resource('customer', App\Http\Controllers\Aquafiltr\CustomerController::class);
            // nhóm thiết bị
            Route::resource('device', App\Http\Controllers\Aquafiltr\AppointmentController::class);
            // nhóm tài khoản
            Route::resource('user', App\Http\Controllers\UserController::class);
            // nhóm vai trò
            Route::resource('role', App\Http\Controllers\RoleController::class);
            // nhóm quyền hạn
            Route::resource('permission', App\Http\Controllers\PermissionController::class);
        });
        // nhóm đăng nhập
        Route::prefix('/auth')->middleware('guest')->group(function () {
            Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
            Route::post('/login', [App\Http\Controllers\AuthController::class, 'handleLogin'])->name('login');
            Route::get('/forgot-password', [App\Http\Controllers\AuthController::class, 'showForgotPassword'])->name('password.request');
            Route::post('/forgot-password', [App\Http\Controllers\AuthController::class, 'sendResetLink'])->name('password.email');
        });
    });
});
