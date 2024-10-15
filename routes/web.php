<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\HomeController;

// Ruta para la página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Autenticación
Auth::routes();

// Ruta para la página de inicio después de iniciar sesión
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas para el recurso customer, protegidas con autenticación
Route::resource('customer', CustomerController::class)->middleware('auth');

// Ruta para eliminar un cliente, protegida con autenticación
Route::delete('customer/{customer}', [CustomerController::class, 'destroy'])
    ->name('customer.destroy')
    ->middleware('auth');

// Ruta para restaurar un cliente, protegida con autenticación
Route::get('customer/{customer}/restore', [CustomerController::class, 'restore'])
    ->name('customer.restore')
    ->middleware('auth');

Route::get('/imprimir', [App\Http\Controllers\GeneradorController::class, 'imprimir'])->name('imprimir');

Route::resource('supplier', SupplierController::class)->middleware('auth');

// Ruta para restaurar un proveedor (borrado lógico)
Route::middleware(['auth'])->group(function () {
    Route::resource('suppliers', SupplierController::class);
    Route::post('suppliers/{id}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');
});

Route::resource('product', App\Http\Controllers\ProductController::class)->middleware('auth');
Route::get('product/{id}/restore', [App\Http\Controllers\ProductController::class, 'restore'])->name('product.restore');

Route::get('/imprimir-productos', [App\Http\Controllers\ProductController::class, 'imprimirProductos'])->name('product.pdf');
Route::get('/imprimir/customers', [App\Http\Controllers\CustomerController::class, 'imprimirCustomers'])->name('customers.pdf');
Route::get('/imprimir/suppliers', [App\Http\Controllers\SupplierController::class, 'imprimirSuppliers'])->name('suppliers.pdf');


