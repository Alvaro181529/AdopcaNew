<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VeterinariaController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login');

Route::prefix('google-auth')->group(function () {
    Route::get('/redirect', [GoogleAuthController::class, 'redirectToGoogle']);
    Route::get('/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::patch('picture', [AvatarController::class, 'update'])->name('picture.update');
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('veterinaria')->name('veterinaria.')->group(function () {
        Route::get('/show', [VeterinariaController::class, 'index'])->name('show');
        Route::get('/update', [VeterinariaController::class, 'create'])->name('update');
    });
});
require __DIR__ . '/auth.php';
