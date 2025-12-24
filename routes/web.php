<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
//login
Route::get('/', function () {
    return redirect('home');
});

require __DIR__ . '/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified', 'usertype:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* User Dashboard */
Route::middleware(['auth', 'verified', 'usertype:user'])->prefix('user')->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');
});
