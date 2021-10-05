<?php

use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['guest'])->group(function () {
    // SignUp
    Route::get('/signup', [SignUpController::class, 'index'])->name('signup');
    Route::post('/signup', [SignUpController::class, 'create']);
    // SignIn
    Route::get('/', [SignInController::class, 'index'])->name('signin');
    Route::post('/signin', [SignInController::class, 'signin']);

    // Email Verification
    Route::get('/email/verify/{id}', [HomeController::class, 'emailVerify']);
    Route::get('/email/verified', [HomeController::class, 'emailVerified'])->name('email.verified');
});


Route::middleware(['auth'])->group(
    function () {
        // Dashboard
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        // Logout
        Route::post('/logout', [LogOutController::class, 'index'])->name('logout');
    }
);

Route::fallback(function () {
    return redirect()->route('dashboard');
});
