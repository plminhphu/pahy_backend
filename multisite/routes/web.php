<?php

use Illuminate\Support\Facades\Route;


// Domain pahy.vn
Route::domain('pahy.vn')->group(function () {
    Route::get('/', [App\Http\Controllers\Pahy\HomeController::class, 'index']);
});

// Domain plminhphu.com
Route::domain('plminhphu.com')->group(function () {
    Route::get('/', [App\Http\Controllers\Phucom\HomeController::class, 'index']);
    Route::get('/chinh-sach-bao-mat-du-lieu-thuy-chuan-vn', [App\Http\Controllers\Tracdia\HomeController::class, 'thuychuan']);
});
// Domain plminhphu.vn
Route::domain('plminhphu.vn')->group(function () {
    Route::get('/', [App\Http\Controllers\Phuvn\HomeController::class, 'index']);
});
// Domain tracdiamiennam.vn
Route::domain('tracdiamiennam.vn')->group(function () {
    Route::get('/', [App\Http\Controllers\Tracdia\HomeController::class, 'index']);
    Route::get('/chinh-sach-bao-mat-du-lieu-thuy-chuan-vn', [App\Http\Controllers\Tracdia\HomeController::class, 'thuychuan']);
});

// Domain aquafiltr-shop.com
Route::domain('aquafiltr-shop.com')->group(function () {
    Route::get('/', [App\Http\Controllers\Aquafiltr\HomeController::class, 'index']);
    Route::prefix('/admin')->group(function () {
        // Route::get('/', function() { return 'OK'; });
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/logout', [App\Http\Controllers\ProfileController::class, 'logout'])->name('logout');


        Route::resource('appointments', App\Http\Controllers\Aquafiltr\Admin\AppointmentController::class);
        // Route::resource('dashboard', App\Http\Controllers\Aquafiltr\Admin\DashboardController::class);
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        // bổ sung route xuất PDF & mã vạch
        Route::get('appointments/{id}/invoice', [App\Http\Controllers\Aquafiltr\Admin\AppointmentController::class, 'invoice'])->name('appointments.invoice');
        Route::get('appointments/{id}/barcode', [App\Http\Controllers\Aquafiltr\Admin\AppointmentController::class, 'barcode'])->name('appointments.barcode');
    });
});

// còn lại
Route::domain('{sub}.pahy.vn')->group(function () {
    Route::get('/', [App\Http\Controllers\Sites\HomeController::class, 'index']);
});