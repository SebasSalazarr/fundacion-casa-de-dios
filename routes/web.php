<?php

use App\Http\Controllers\DonacionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('inicio');
Route::view('/fotos', 'fotos')->name('fotos');

// Pestañas abiertas o enlaces viejos llegan por GET: se llevan al formulario.
Route::get('/donar', fn () => redirect(route('inicio').'#donar'));
Route::post('/donar', [DonacionController::class, 'iniciar'])->name('donar');
Route::get('/donar/gracias/{donacion}', [DonacionController::class, 'gracias'])->name('donar.gracias');
Route::post('/wompi/eventos', [DonacionController::class, 'evento'])->name('wompi.eventos');
