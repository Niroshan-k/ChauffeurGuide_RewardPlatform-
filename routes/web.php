<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\RedemptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/guide/dashboard', [GuideController::class, 'dashboard']);
    Route::post('/guide/redeem', [RedemptionController::class, 'redeem']);
});


Route::get('/admin/dashboard', function () { return view('admin.dashboard'); });
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    
});

Route::get('/admin/login', function () {
    return view('admin.login');
});

// Route::get('/login', function () {
//     return redirect('/admin/login');
// })->name('login');
