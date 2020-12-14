<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| NOTAS DEL PROYECTO
|--------------------------------------------------------------------------
|
| Correr las migraciones y el seed "UserSeeder"
| Estoy usando 'engine' => 'InnoDB' en 'database.php' del folder config.
| Aunque me hubiera gustado incluir Seeders para el resto de las tablas,
| decidí no incluirlos para que se pudiera comprobar la funcionalidad
| de los CRUD.
| Los usuarios creados en el Seeder de Usuario son:
|
| ADMINISTRADOR
| Correo: correo@gmail.com
| Contraseña: password
|
| USUARIO
| Correo: mail@gmail.com
| Contraseña: password
|
| Para el administrador, se puede acceder a las pantallas de los CRUDs
| dando clic en el nombre de usuario en la esquina superior derecha.
| Ahí se tiene acceso a las tablas básicas para la implementación del sistema.
|
| El Usuario solo podrá reservar habitaciones.
|
| Para probar el sistema, se deben generar registros en las sig. tablas
| en el sig. orden:
|
| - Pais
| - Hotel
| - TipoHabitacion
| - Habitacion
|
| Una vez creados los registros, se puede ir a la PORTADA (en la esquina
| superior izquierda) para poder definir las fechas de checkIn y checkOut y así,
| empezar a buscar habitaciones para reservar.
|
| El carrito del usuario estará en la misma zona que el panel de los CRUDs.
|
| Para llevar a cabo la reserva, se debe ir al carrito y presionar el botón de
| "Realizar Reserva"
|
| Todas las habitaciones reservadas aparecerán en la sección "Tus Reservas"
|
*/

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
Route::get('/','HomeController@portada');
Route::get('/home','HomeController@portada');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Recursos
Route::resource('carritoHabitaciones', carritoHabitaciones::class)->only([
    'index', 'store', 'destroy'
]);;
Route::resource('direcciones', direcciones::class)->only([
    'index'
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
    'index', 'create', 'store', 'destroy'
]);;
Route::resource('tipoHabitaciones', tipoHabitaciones::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);;
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Carrito Habitaciones
Route::get('/carrito','carritoHabitaciones@index');
Route::post('/carrito','carritoHabitaciones@store');
Route::delete('/carrito/{id}','carritoHabitaciones@destroy');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Direcciones
Route::get('/direcciones','direcciones@index');
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// Habitaciones
Route::get('/habitaciones','habitaciones@index');
Route::post('/habitacionesFiltradas','habitaciones@indexFiltro');
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
Route::delete('/reservas/{id}','reservas@destroy');
Route::get('/reservaConfirmada','HomeController@reservaConfirmada');
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
