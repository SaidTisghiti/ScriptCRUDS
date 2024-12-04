<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('new_users', App\Http\Controllers\NewUserController::class);

Route::resource('posts', App\Http\Controllers\PostController::class);

Route::resource('comments', App\Http\Controllers\CommentController::class);

Route::resource('coches', App\Http\Controllers\CochController::class);

Route::resource('clientes', App\Http\Controllers\ClienteController::class);

Route::resource('empleados', App\Http\Controllers\EmpleadoController::class);

Route::resource('ventas', App\Http\Controllers\VentaController::class);

Route::resource('mantenimientos', App\Http\Controllers\MantenimientoController::class);

Route::resource('cars', App\Http\Controllers\CarController::class);

Route::resource('customers', App\Http\Controllers\CustomerController::class);

Route::resource('employees', App\Http\Controllers\EmployeeController::class);

Route::resource('sales', App\Http\Controllers\SaleController::class);

Route::resource('maintenance', App\Http\Controllers\MaintenanceController::class);
