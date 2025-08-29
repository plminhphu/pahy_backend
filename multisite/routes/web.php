<?php

use Illuminate\Support\Facades\Route;

// Lấy domain hiện tại
$currentDomain = request()->getHost();
// Đường dẫn file route theo domain
$domainRouteFile = base_path("routes/{$currentDomain}.php");
// Nếu tồn tại thì load
if (file_exists($domainRouteFile)) {
    Route::middleware('web')->group($domainRouteFile);
} else {
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

    // còn lại
    Route::domain('{sub}.pahy.vn')->group(function () {
        Route::get('/', [App\Http\Controllers\Sites\HomeController::class, 'index']);
    });
}
