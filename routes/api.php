<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedemptionController;

// --- Public routes (no auth needed) ---

// Guide login
Route::post('/guide/login', [AuthController::class, 'guideLogin']);

// Admin login
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// --- Protected routes for guides ---
Route::middleware(['auth:sanctum'])->group(function () {

    // Guide dashboard
    Route::get('/guide/dashboard', [GuideController::class, 'dashboard']);

    // Redeem points
    Route::post('/guide/redeem', [RedemptionController::class, 'redeemPoints']);
});


// --- Protected routes for admins ---
Route::middleware(['auth:sanctum'])->group(function () {

    // Admin guide management
    Route::post('/admin/guides', [AdminController::class, 'store']);
    Route::put('/admin/guides/{id}', [AdminController::class, 'update']);
    Route::delete('/admin/guides/{id}', [AdminController::class, 'destroy']);
    Route::get('/admin/guides', [AdminController::class, 'index']);
    Route::get('/admin/guides/{id}', [AdminController::class, 'show']);

    // Admin updates visit and tourist count
    Route::post('/admin/guides/{id}/update-activity', [AdminController::class, 'updateActivity']);
});
