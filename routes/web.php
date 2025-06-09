<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AlamatController;

Route::get('/', function () {
    return view('welcome');
});



Route::resource('pasien', PasienController::class);
Route::get('/get-kotas/{provinsi_id}', [AlamatController::class, 'getKotas']);
Route::get('/get-kecamatans/{kota_id}', [AlamatController::class, 'getKecamatans']);
Route::get('/get-desas/{kecamatan_id}', [AlamatController::class, 'getDesas']);
