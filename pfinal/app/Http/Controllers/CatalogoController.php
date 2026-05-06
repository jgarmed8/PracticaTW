<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    private function productos()
    {
        return config('productos');
    }

    public function index(Request $request)
    {
        $productos = $this->productos();

        $busqueda = trim($request->query('busqueda', ''));
        $categoria = $request->query('categoria', '');
        $orden = $request->query('orden', '');

        if ($busqueda !== '') {
            $texto = mb_strtolower($busqueda);

            $productos = array_filter($productos, function ($producto) use ($texto) {
                return str_contains(mb_strtolower($producto['nombre']), $texto)
                    || str_contains(mb_strtolower($producto['descripcion']), $texto)
                    || str_contains(mb_strtolower($producto['categoria']), $texto);
            });
        }

        if ($categoria !== '') {
            $productos = array_filter($productos, function ($producto) use ($categoria) {
                return $producto['categoria'] === $categoria;
            });
        }

        if ($orden === 'precio_asc') {
            usort($productos, function ($a, $b) {
                return $a['precio'] <=> $b['precio'];
            });
        }

        if ($orden === 'precio_desc') {
            usort($productos, function ($a, $b) {
                return $b['precio'] <=> $a['precio'];
            });
        }

        if ($orden === 'stock_desc') {
            usort($productos, function ($a, $b) {
                return $b['stock'] <=> $a['stock'];
            });
        }

        return view('catalogo', [
            'productos' => $productos,
            'busqueda' => $busqueda,
            'categoriaSeleccionada' => $categoria,
            'ordenSeleccionado' => $orden,
        ]);
    }

    public function detalle($slug)
    {
        $producto = collect($this->productos())->firstWhere('slug', $slug);

        if (!$producto) {
            abort(404);
        }

        return view('producto', [
            'producto' => $producto,
        ]);
    }
}