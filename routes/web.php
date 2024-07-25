<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\RequestVerificationController;
use App\Http\Controllers\UserVideoController;

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

// Admin routes
Route::prefix('admin')->group(function() {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('admin.home')->middleware('admin');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::resource('users', UserController::class)->middleware('auth:admin');
    Route::resource('videos', VideoController::class)->middleware('auth:admin');
    
    Route::get('requests', [RequestVerificationController::class, 'index'])->name('requests.index')->middleware('auth:admin');
    Route::post('requests/{id_request}/toggle-access', [RequestVerificationController::class, 'toggleAccess'])->name('requests.toggle');
    Route::delete('requests/{id_request}', [RequestVerificationController::class, 'destroy'])->name('requests.destroy');
});

// User routes
Route::middleware(['web'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [HomeController::class, 'index'])->middleware('auth');

    Route::get('home', [UserVideoController::class, 'index'])->name('home');
    Route::post('videos/{video}/request-access', [UserVideoController::class, 'requestAccess'])->name('user.videos.requestAccess');
});

Route::get('/check-session', function () {
    \Log::info('Session data: ', session()->all());
    return response()->json(session()->all());
});

Route::get('/previous-url', function () {
    \Log::info('Previous URL: ' . url()->previous());
    return response()->json(['previous_url' => url()->previous()]);
});
