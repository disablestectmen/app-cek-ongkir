<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk cek ongkir
Route::get('/shipping/check', [HomeController::class, 'checkShipping'])->name('shipping.check');
Route::post('/shipping/process', [HomeController::class, 'processCheckShipping'])->name('shipping.process');

// Rute untuk cari agen terdekat
Route::get('/agent/nearest', [HomeController::class, 'findNearestAgent'])->name('agent.nearest');
Route::post('/agent/process', [HomeController::class, 'processNearestAgent'])->name('agent.process');
