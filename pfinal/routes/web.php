<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/catalogo', function () {
    return view('catalogo');
});

Route::get('/contacto', function () {
    return view('contacto');
});