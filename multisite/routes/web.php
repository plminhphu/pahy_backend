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
        Route::resource('/appointment', App\Http\Controllers\Aquafiltr\Admin\AppointmentController::class);
    });
});

// còn lại
Route::domain('{sub}.pahy.vn')->group(function () {
    Route::get('/', [App\Http\Controllers\Sites\HomeController::class, 'index']);
});