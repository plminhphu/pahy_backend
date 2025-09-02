<?php
use Illuminate\Support\Facades\Route;

// Homepage aquafiltr-shop.com
Route::domain('aquafiltr-shop.com')->group(function () {
    Route::get('/', [App\Http\Controllers\Aquafiltr\HomeController::class, 'index']);
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
