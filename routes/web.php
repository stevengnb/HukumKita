<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->middleware('auth:web,lawyer')->name('home');
Route::get('/articles', [ArticleController::class, 'showArticles']);
Route::get('/articles/{id}', [ArticleController::class, 'showDetail']);
Route::get('/lawyers/{id}', [LawyerController::class, 'getLawyer'])->name('getLawyer');
Route::get('/lawyers/booking/{id}', [LawyerController::class, 'getLawyerBookingPage'])->name('getLawyerBooking');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

// user auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('login-process', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('register-process', [AuthController::class, 'registerProcess'])->name('register.process');
Route::get('lawyers', [LawyerController::class, 'getLawyers'])->name('getLawyers');
// Route::get('lawyer/{id}', [LawyerController::class, 'getLawyer'])->name('getLawyer');

// lawyer auth
Route::prefix('lawyer')->name('lawyer.')->group(function () {
    Route::get('login', [AuthController::class, 'loginLawyer'])->name('login');
    Route::get('register', [AuthController::class, 'registerLawyer'])->name('register');
    Route::post('login-process', [AuthController::class, 'loginProcessLawyer'])->name('login.process');
    Route::post('register-process', [AuthController::class, 'registerProcessLawyer'])->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
