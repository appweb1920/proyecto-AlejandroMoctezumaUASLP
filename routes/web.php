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
    'index', 'create', 'store', 'show', 'edit', 'update', 'destro'
]);;
Route::resource('diaReservas', diaReservas::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destro'
]);;
Route::resource('direcciones', direcciones::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destro'
]);;
Route::resource('habitaciones', habitaciones::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destro'
]);;
Route::resource('hoteles', hoteles::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destro'
]);;
Route::resource('paises', paises::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destro'
]);;
Route::resource('reservas', reservas::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destro'
]);;
Route::resource('tipoHabitaciones', tipoHabitaciones::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destro'
]);;
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// CRUD Formato
Route::get('/', 'Piezas@index');
Route::get('/piezas','Piezas@index');
Route::get('/piezas/create','Piezas@create');
Route::post('/piezas','Piezas@store');
Route::get('/piezas/{id}/edit','Piezas@edit');
Route::put('/piezas/{id}','Piezas@update');
Route::delete('/piezas/{id}','Piezas@destroy');
// -----------------------------------------------------------------------
