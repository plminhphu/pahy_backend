<?php
use Illuminate\Support\Facades\Route;

// Homepage aquafiltr-shop.com
Route::domain('aquafiltr-shop.com')->group(function () {
    // Route::get('/', [App\Http\Controllers\Aquafiltr\HomeController::class, 'index']);

    Route::get('/', [App\Http\Controllers\Aquafiltr\HomeController::class, 'scan']);
    Route::get('code/{id}', [App\Http\Controllers\Aquafiltr\HomeController::class, 'scan']);
    Route::post('code-result', [App\Http\Controllers\Aquafiltr\HomeController::class, 'scanResult']);
    Route::get('customer/barcode/{id}.png', [App\Http\Controllers\Aquafiltr\CustomerController::class, 'barcode'])->name('customer.barcode');
    Route::get('appointment/barcode/{id}.png', [App\Http\Controllers\Aquafiltr\AppointmentController::class, 'barcode'])->name('appointment.barcode');
    Route::get('appointment/invoice/{id}/{type?}', [App\Http\Controllers\Aquafiltr\AppointmentController::class, 'invoice'])->name('appointment.invoice');
    Route::get('sendReminders', [App\Http\Controllers\Aquafiltr\AppointmentController::class, 'sendReminders'])->name('sendReminders');

    // mọi path sau /admin đều chuyển hướng sang admin.aquafiltr-shop.com
    Route::any('/admin/{any?}', function ($any = null) {
        // Lấy full path sau /admin (bao gồm cả query string)
        $target = 'https://admin.aquafiltr-shop.com' . ($any ? '/' . $any : '');
        // Thêm query string nếu có
        if (request()->getQueryString()) {
            $target .= '?' . request()->getQueryString();
        }
        return redirect()->away($target);
    })->where('any', '.*');
});
