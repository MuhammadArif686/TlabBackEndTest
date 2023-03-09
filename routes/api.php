<?php

use Illuminate\Support\Facades\Route;

//posts
Route::apiResource('/kategori', App\Http\Controllers\Api\KategoriController::class);
Route::apiResource('/bahan', App\Http\Controllers\Api\BahanController::class);
Route::apiResource('/resep', App\Http\Controllers\Api\ResepController::class);
Route::apiResource('/listresep', App\Http\Controllers\Api\ListresepController::class);