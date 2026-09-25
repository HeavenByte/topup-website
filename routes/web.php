<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\Auth\SocialiteController;

// Rute untuk mengarahkan ke Google/Facebook
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('social.login');

// Rute callback untuk menerima data dari Google/Facebook
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);
Route::get('/', [HomeController::class, 'index'])->name('home');

// admin rule
Route::get('/admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');
require __DIR__.'/auth.php';
