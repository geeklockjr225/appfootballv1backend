<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AdminController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




// Auth routes (API)
Route::prefix('users')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    
    Route::get('{id}', [UserController::class, 'show']); // get user by ID
});

// middlewrare used to protect the routes


Route::middleware('auth:sanctum')->get('/user-profile', [UserController::class, 'profile']);
Route::middleware('auth:sanctum')->get('/user-logout', [UserController::class, 'logout']);

//  Admin routes

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::post('/register-coach',     [AdminController::class, 'registerCoach']);
    Route::post('/register-parent-joueur',    [AdminController::class, 'registerParentJoueur']);
    Route::post('/register-assistant', [AdminController::class, 'registerAssistantAdmin']);
});









