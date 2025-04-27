<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\ShippingController;

// API Wilayah Indonesia
Route::get('/provinces', [RegionController::class, 'getProvinces']);
Route::get('/provinces/{province_id}/regencies', [RegionController::class, 'getRegencies']);
Route::get('/provinces/{province_id}/regencies/{regency_id}/districts', [RegionController::class, 'getDistricts']);
Route::get('/provinces/{province_id}/regencies/{regency_id}/districts/{district_id}/villages', [RegionController::class, 'getVillages']);

// API Raja Ongkir
Route::get('/shipping/destination', [ShippingController::class, 'searchDestination']);
Route::post('/shipping/calculate', [ShippingController::class, 'calculateShipping']);
Route::get('/shipping/nearest-agents', [ShippingController::class, 'getNearestAgents']);
