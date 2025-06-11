<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedemptionController;
use App\Http\Controllers\VisitController;

// --- Public routes (no auth needed) ---

// filepath: /Applications/XAMPP/xamppfiles/htdocs/ChauffeurGuide_RewardPlatform/routes/api.php
Route::get('/test', function () {
    return 'test';
});
// Guide login
Route::post('/guide/login', [AuthController::class, 'guideLogin']);

// Admin login
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// --- Protected routes for guides ---
Route::middleware(['auth:sanctum'])->group(function () {

    // Guide dashboard
    Route::get('/guide/dashboard', [GuideController::class, 'dashboard']);

    // Redeem points
    Route::post('/guide/{guide_id}/redeem', [RedemptionController::class, 'store']);
});


// --- Protected routes for admins ---
Route::middleware(['auth:sanctum'])->group(function () {

    // Admin guide management
    Route::post('/admin/guides', [GuideController::class, 'store']);
    Route::put('/admin/guides/{id}', [GuideController::class, 'update']);
    Route::delete('/admin/guides/{id}', [GuideController::class, 'destroy']);
    Route::get('/admin/guides', [GuideController::class, 'index']);
    Route::get('/admin/guides/{id}', [GuideController::class, 'show']);
    Route::post('admin/visits', [VisitController::class, 'store']);

    // Admin updates visit and tourist count
    Route::post('/admin/guides/{id}/update-activity', [AdminController::class, 'updateActivity']);
});


// --- Public route to create an admin ---
// Route::post('/admin/register', [AdminController::class, 'store']);