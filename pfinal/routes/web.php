<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;

Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');

Route::get('/producto/{slug}', [CatalogoController::class, 'detalle'])->name('producto.detalle');

Route::post('/carrito/agregar', [CatalogoController::class, 'agregarCarrito'])->name('carrito.agregar');

Route::post('/deseos/agregar', [CatalogoController::class, 'agregarDeseo'])->name('deseos.agregar');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');