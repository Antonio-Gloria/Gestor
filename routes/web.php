<?php

use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
Route::resource('/servicios', App\Http\Controllers\ServicioController::class)->except(['create'])->middleware('auth');
Route::resource('/tiposervicios', App\Http\Controllers\TipoServicioController::class)->middleware('auth');
Route::resource('/tecnicos', App\Http\Controllers\TecnicoController::class)->middleware('auth');
Route::get('delete-tiposervicio/{tiposervicio_id}', [App\Http\Controllers\TipoServicioController::class, 'delete_tiposervicio'])->name('delete-tiposervicio')->middleware('auth');
Route::get('delete-tecnico/{tecnico_id}', [App\Http\Controllers\TecnicoController::class, 'delete_tecnico'])->name('delete-tecnico')->middleware('auth');
Route::get('realizado-servicio/{servicio_id}', [App\Http\Controllers\ServicioController::class, 'realizado_servicio'])->name('realizado-servicio')->middleware('auth');
Route::get('delete-servicio/{servicio_id}', [App\Http\Controllers\ServicioController::class, 'delete_servicio'])->name('delete-servicio')->middleware('auth');
Route::get('/servicio/realizado', [ServicioController::class, 'realizado'])->name('servicios.realizado')->middleware('auth');
Route::get('/info-servicio', [ServicioController::class, 'info'])->name('info-servicio')->middleware('auth');
Route::get('/servicio/info/{id}', [ServicioController::class, 'infoServicio'])->name('info-servicio')->middleware('auth');
Route::post('/realizar-servicio', [ServicioController::class, 'realizarServicio'])->name('realizar-servicio')->middleware('auth');
