<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider. All routes defined
| here are automatically prefixed with '/api'.
|
*/

// Default route often used for authentication starters
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Defines all RESTful API routes (index, show, store, update, destroy) for the User resource.
// e.g., GET /api/users calls UserController@index
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::apiResource('users', UserController::class);
// Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
Route::apiResource('hotels', HotelController::class);
