<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TrajetController as AdminTrajetController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FooterPageController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TrajetAvailabilityController;
use App\Http\Controllers\TrajetSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Language switching route
Route::get('/language/{locale}', [LocalizationController::class, 'setLanguage'])->name('language.switch');

Route::get('/villes', [FooterPageController::class, 'villes'])->name('pages.villes');
Route::get('/partenaires', [FooterPageController::class, 'partenaires'])->name('pages.partenaires');
Route::get('/programme-de-parrainage', [FooterPageController::class, 'parrainage'])->name('pages.parrainage');
Route::get('/offres', [FooterPageController::class, 'offres'])->name('pages.offres');
Route::get('/mkhyer', [FooterPageController::class, 'mkhyer'])->name('pages.mkhyer');
Route::get('/paiement-en-especes', [FooterPageController::class, 'paiementEnEspeces'])->name('pages.paiement-en-especes');
Route::get('/contactez-nous', [FooterPageController::class, 'contactezNous'])->name('pages.contactez-nous');
Route::get('/centre-aide', [FooterPageController::class, 'centreAide'])->name('pages.centre-aide');
Route::get('/confidentialite', [FooterPageController::class, 'confidentialite'])->name('pages.confidentialite');
Route::get('/conditions', [FooterPageController::class, 'conditions'])->name('pages.conditions');
Route::get('/carrieres', [FooterPageController::class, 'carrieres'])->name('pages.carrieres');
Route::get('/blog', [FooterPageController::class, 'blog'])->name('pages.blog');
Route::get('/markoub-sahbi', [FooterPageController::class, 'markoubSahbi'])->name('pages.markoub-sahbi');

Route::get('/recherche', [TrajetSearchController::class, 'index'])->name('trajets.search');

Route::get('/trajets/{trajet}/disponibilite', TrajetAvailabilityController::class)
    ->name('trajets.availability');

Route::middleware(['auth'])->group(function () {
    Route::get('/mes-reservations', [ReservationController::class, 'index'])->name('reservations.mine');
    Route::get('/trajets/{trajet}/reserver', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/trajets/{trajet}/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}/confirmation', [ReservationController::class, 'success'])->name('reservations.success');

    // Payment routes
    Route::get('/reservations/{reservation}/payment', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/reservations/{reservation}/payment', [PaymentController::class, 'process'])->name('payments.process');
    Route::get('/payments/{payment}/success', [PaymentController::class, 'success'])->name('payments.success');
    Route::get('/payments/{payment}/invoice', [PaymentController::class, 'invoice'])->name('payments.invoice');
    Route::get('/payments/{payment}/failed', [PaymentController::class, 'failed'])->name('payments.failed');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::resource('trajets', AdminTrajetController::class)->except(['show']);
    Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
});

require __DIR__ . '/auth.php';
