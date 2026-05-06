<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DeseosController;
use App\Http\Controllers\PerfilController;

Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');
Route::get('/producto/{slug}', [CatalogoController::class, 'detalle'])->name('producto.detalle');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::put('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{slug}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

Route::get('/checkout', [CarritoController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CarritoController::class, 'confirmar'])->name('checkout.confirmar');

Route::get('/deseos', [DeseosController::class, 'index'])->name('deseos');
Route::post('/deseos/agregar', [DeseosController::class, 'agregar'])->name('deseos.agregar');
Route::delete('/deseos/eliminar/{slug}', [DeseosController::class, 'eliminar'])->name('deseos.eliminar');

Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');