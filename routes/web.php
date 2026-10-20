<?php

use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('pasien.index'));
Route::resource('pasien', PasienController::class)->except('show');