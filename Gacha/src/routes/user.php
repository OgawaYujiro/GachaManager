<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\GachaController;

Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login.login');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/Gacha', [GachaController::class, 'index']);

Route::prefix('user')->group(function () {
  Route::get('/', [HomeController::class, 'dashboard'])->name('user.dashboard');
});

Route::prefix('user')->middleware('auth.members:members')->group(function () {
  Route::get('/', [HomeController::class, 'dashboard'])->name('user.dashboard');
});