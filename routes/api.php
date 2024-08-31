<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('user/login', [UserAuthController::class, 'login']);
Route::post('admin/login', [AdminAuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index']);

    Route::get('/users', [UserController::class, 'index']); // Get all users
    Route::get('/users/{id}', [UserController::class, 'show']); // Get a user by ID
    Route::get('/users/search', [UserController::class, 'search']); // Search for users

});
// Route::middleware('auth:api')->group(function () {
//     Route::get('/users', [UserController::class, 'index']); // Get all users
//     Route::get('/users/{id}', [UserController::class, 'show']); // Get a user by ID
//     Route::get('/users/search', [UserController::class, 'search']); // Search for users
// });

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});
