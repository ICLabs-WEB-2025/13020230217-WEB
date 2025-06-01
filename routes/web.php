<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
       return auth()->user()->isAdmin() 
            ? redirect()->route('filament.admin.pages.dashboard') 
            : redirect()->route('user.dashboard');
    })->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/schedule/{field}', [DashboardController::class, 'showSchedule'])->name('user.schedule.show');
        
        Route::prefix('book')->group(function () {
            Route::get('/{schedule}', [BookingController::class, 'create'])->name('user.book');
            Route::post('/{schedule}', [BookingController::class, 'store'])->name('user.book.store');
            Route::get('/{id}/download', [BookingController::class, 'download'])->name('user.book.download');
            Route::post('/{id}/cancel', [BookingController::class, 'cancel'])->name('user.book.cancel');
        });
        
        Route::get('/bookings', [BookingController::class, 'index'])->name('user.bookings');
        
        Route::get('/booking-history', [DashboardController::class, 'bookingHistory'])
            ->name('user.booking.history');
        Route::get('/payment-history', [DashboardController::class, 'paymentHistory'])
            ->name('user.payment.history');
    });

    Route::prefix('payments')->group(function () {
        Route::get('/{booking}/show', [PaymentController::class, 'show'])->name('user.payment.show');
        Route::post('/{booking}/process', [PaymentController::class, 'process'])->name('user.payment.process');
        Route::get('/{payment}/simulate', [PaymentController::class, 'showSimulation'])
            ->name('user.payment.simulate');
        Route::post('/{payment}/simulate/confirm', [PaymentController::class, 'confirmSimulation'])
            ->name('user.payment.simulate.confirm');
    });
});

Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

