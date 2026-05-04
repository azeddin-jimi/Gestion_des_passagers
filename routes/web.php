<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TrajetController as AdminTrajetController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TrajetAvailabilityController;
use App\Http\Controllers\TrajetSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/recherche', [TrajetSearchController::class, 'index'])->name('trajets.search');

Route::get('/trajets/{trajet}/disponibilite', TrajetAvailabilityController::class)
    ->name('trajets.availability');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mes-reservations', [ReservationController::class, 'index'])->name('reservations.mine');
    Route::get('/trajets/{trajet}/reserver', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/trajets/{trajet}/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::resource('trajets', AdminTrajetController::class)->except(['show']);
    Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
});

require __DIR__.'/auth.php';
