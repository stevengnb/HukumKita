<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->middleware('auth:web,lawyer');
Route::get('/articles', [ArticleController::class, 'showArticles']);

// user auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('login-process', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('register-process', [AuthController::class, 'registerProcess'])->name('register.process');

// lawyer auth
Route::prefix('lawyer')->name('lawyer.')->group(function () {
    Route::get('login', [AuthController::class, 'loginLawyer'])->name('login');
    Route::get('register', [AuthController::class, 'registerLawyer'])->name('register');
    Route::post('login-process', [AuthController::class, 'loginProcessLawyer'])->name('login.process');
    Route::post('register-process', [AuthController::class, 'registerProcessLawyer'])->name('register.process');
});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
