<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// -----------------------------------------------------------------------
// Otros
Auth::routes();
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Recursos
Route::resource('carritoHabitaciones', carritoHabitaciones::class)->only([
    'index', 'store', 'destroy'
]);;
Route::resource('diaReservas', diaReservas::class)->only([
    'index', 'store', 'destroy'
]);;
Route::resource('direcciones', direcciones::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);;
Route::resource('habitaciones', habitaciones::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);;
Route::resource('hoteles', hoteles::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);;
Route::resource('paises', paises::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);;
Route::resource('reservas', reservas::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update'
]);;
Route::resource('tipoHabitaciones', tipoHabitaciones::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);;
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Carrito Habitaciones
Route::get('/carritoHabitaciones','carritoHabitaciones@index');
Route::post('/carritoHabitaciones','carritoHabitaciones@store');
Route::delete('/carritoHabitaciones/{id}','carritoHabitaciones@destroy');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Dia Reservas
Route::get('/diaReservas','diaReservas@index');
Route::post('/diaReservas','diaReservas@store');
Route::delete('/diaReservas/{id}','diaReservas@destroy');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Direcciones
Route::get('/direcciones','direcciones@index');
Route::get('/direcciones/create','direcciones@create');
Route::post('/direcciones','direcciones@store');
Route::get('/direcciones/{id}/edit','direcciones@edit');
Route::put('/direcciones/{id}','direcciones@update');
Route::delete('/direcciones/{id}','direcciones@destroy');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Habitaciones
Route::get('/habitaciones','habitaciones@index');
Route::get('/habitaciones/create','habitaciones@create');
Route::post('/habitaciones','habitaciones@store');
Route::get('/habitaciones/{id}/edit','habitaciones@edit');
Route::put('/habitaciones/{id}','habitaciones@update');
Route::delete('/habitaciones/{id}','habitaciones@destroy');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Hoteles
Route::get('/hoteles','hoteles@index');
Route::get('/hoteles/create','hoteles@create');
Route::post('/hoteles','hoteles@store');
Route::get('/hoteles/{id}/edit','hoteles@edit');
Route::put('/hoteles/{id}','hoteles@update');
Route::delete('/hoteles/{id}','hoteles@destroy');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Paises
Route::get('/paises','paises@index');
Route::get('/paises/create','paises@create');
Route::post('/paises','paises@store');
Route::get('/paises/{id}/edit','paises@edit');
Route::put('/paises/{id}','paises@update');
Route::delete('/paises/{id}','paises@destroy');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Reservas
Route::get('/reservas','reservas@index');
Route::get('/reservas/create','reservas@create');
Route::post('/reservas','reservas@store');
Route::get('/reservas/{id}','reservas@show');
Route::get('/reservas/{id}/edit','reservas@edit');
Route::put('/reservas/{id}','reservas@update');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Tipo Habitaciones
Route::get('/tipoHabitaciones','tipoHabitaciones@index');
Route::get('/tipoHabitaciones/create','tipoHabitaciones@create');
Route::post('/tipoHabitaciones','tipoHabitaciones@store');
Route::get('/tipoHabitaciones/{id}/edit','tipoHabitaciones@edit');
Route::put('/tipoHabitaciones/{id}','tipoHabitaciones@update');
Route::delete('/tipoHabitaciones/{id}','tipoHabitaciones@destroy');
// -----------------------------------------------------------------------
