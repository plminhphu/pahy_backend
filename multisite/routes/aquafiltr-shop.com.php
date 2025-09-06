<?php
use Illuminate\Support\Facades\Route;

// Homepage aquafiltr-shop.com
Route::domain('aquafiltr-shop.com')->group(function () {
    Route::get('/', [App\Http\Controllers\Aquafiltr\HomeController::class, 'index']);

    Route::get('scan', [App\Http\Controllers\Aquafiltr\HomeController::class, 'scan']);
    Route::get('scan/{id}', [App\Http\Controllers\Aquafiltr\HomeController::class, 'scan']);
    Route::post('scan-result', [App\Http\Controllers\Aquafiltr\HomeController::class, 'scanResult']);
    Route::get('customer/barcode/{id}', [App\Http\Controllers\Aquafiltr\CustomerController::class, 'barcode'])->name('customer.barcode');
    Route::get('appointment/barcode/{id}', [App\Http\Controllers\Aquafiltr\AppointmentController::class, 'barcode'])->name('appointment.barcode');
    Route::get('appointment/invoice/export/{id}', [App\Http\Controllers\Aquafiltr\AppointmentController::class, 'invoice'])->name('appointment.invoice');
    Route::get('appointment/invoice/view/{id}', [App\Http\Controllers\Aquafiltr\AppointmentController::class, 'viewinvoice'])->name('appointment.view.invoice');
    
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
