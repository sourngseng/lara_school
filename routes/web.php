<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\TelegramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// routes/web.php
// routes/web.php
Route::get('/translations/{locale}', function ($locale) {
    App::setLocale($locale);
    return response()->json([
        'language' => trans('language')
    ]);
});




Route::get('/', function () {
    // return view('welcome');
    return view('frontpage.index');
});
Route::get('/blog', function () {
    // return view('welcome');
    return view('frontpage.blog');
});

// Telegram Login
Route::get('/login/telegram', [TelegramController::class, 'redirectToTelegram'])->name('telegram.login');
Route::get('/login/telegram/callback', [TelegramController::class, 'handleTelegramCallback']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'loginWeb'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Protected routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create',[UserController::class, 'create'])->name('admin.users.create');
        Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::post('/users/store',[UserController::class, 'store'])->name('admin.users.store');
        //delete
        // Route::get('/users/delete/{id}',[UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/list-test', function () {
            // return view('welcome');
            // return view('layouts.auth_app');
            return view('samples.index');
        });
    });
});