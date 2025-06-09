<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('register');
});
Route::post('/registerstore', [AuthController::class, 'registerstore'])->name('store');
Route::get('/otp-verify', function () {
    return view('otp-verify');
})->name('otp.verify');
Route::get('/dashbaord', function () {
    return view('welcome');
})->name('dashboard');
