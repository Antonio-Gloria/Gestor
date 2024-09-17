<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/servicios', App\Http\Controllers\ServicioController::class)
    ->except(['show'])
    ->middleware('auth');

    Route::resource('/tiposervicios', App\Http\Controllers\TipoServicioController::class)
    ->except(['show'])
    ->middleware('auth');

    Route::get('delete-tiposervicio/{tiposervicio_id}',[
        'as' => 'delete-tiposervicio',
        'middleware' => 'auth',
        'uses'=> 'App\Http\Controllers\TipoServicioController@delete_tiposervicio'
    ]);

    Route::get('delete-servicio/{servicio_id}',[
        'as' => 'delete-servicio',
        'middleware' => 'auth',
        'uses'=> 'App\Http\Controllers\ServicioController@delete_servicio'
    ]);
    

