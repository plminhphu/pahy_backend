<?php

use Illuminate\Support\Facades\Route;

Route::domain('{sub}.pahy.vn')->group(function () {
    Route::get('/', function ($sub) {
        return view('pahy.home');
    });
});

Route::domain('pahy.vn')->group(function () {
    Route::get('/', function () {
        return view('pahy.home');
    });
});
Route::get('/', function () {
    return view('pahy.home');
});