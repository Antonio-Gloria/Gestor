<?php

use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
Use App\Http\Controllers\DashboardController;

//usuarios
Route::middleware(['auth', 'can:users.create'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta para crear servicio sin loggearse
Route::get('/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');


Route::resource('/servicios', App\Http\Controllers\ServicioController::class)
    ->except(['create', 'store'])
    ->middleware('auth');

Route::resource('/users', UserController::class)->middleware('auth')->except(['show']);

Route::resource('/tiposervicios', App\Http\Controllers\TipoServicioController::class)->middleware('auth');
Route::resource('/tecnicos', App\Http\Controllers\TecnicoController::class)->middleware('auth');
Route::get('delete-tiposervicio/{tiposervicio_id}', [App\Http\Controllers\TipoServicioController::class, 'delete_tiposervicio'])->name('delete-tiposervicio')->middleware('auth');
Route::get('delete-tecnico/{tecnico_id}', [App\Http\Controllers\TecnicoController::class, 'delete_tecnico'])->name('delete-tecnico')->middleware('auth');
Route::get('realizado-servicio/{servicio_id}', [App\Http\Controllers\ServicioController::class, 'realizado_servicio'])->name('realizado-servicio')->middleware('auth');
Route::get('delete-servicio/{servicio_id}', [App\Http\Controllers\ServicioController::class, 'delete_servicio'])->name('delete-servicio')->middleware('auth');
Route::get('/servicio/realizado', [ServicioController::class, 'realizado'])->name('servicios.realizado')->middleware('auth');
Route::get('/info-servicio', [ServicioController::class, 'info'])->name('info-servicio')->middleware('auth');
Route::get('/servicio/info/{id}', [ServicioController::class, 'infoServicio'])->name('info-servicio')->middleware('auth');
Route::post('/servicio/realizar', [ServicioController::class, 'realizarServicio'])->name('realizar-servicio')->middleware('auth');
Route::post('/realizar-servicio', [ServicioController::class, 'realizarServicio'])->name('realizar-servicio')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
