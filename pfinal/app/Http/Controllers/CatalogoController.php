<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    private function productos()
    {
        return [
            [
                'slug' => 'taza-azul',
                'nombre' => 'Taza azul',
                'categoria' => 'Tazas',
                'descripcion' => 'Taza de cerámica esmaltada a mano. Es una pieza sencilla para uso diario.',
                'precio' => 12.50,
                'stock' => 8,
                'imagen' => 'img/productos/tazas.jpg',
                'alt' => 'Tazas de cerámica artesanal',
            ],
            [
                'slug' => 'jarron-blanco',
                'nombre' => 'Jarrón blanco',
                'categoria' => 'Jarrones',
                'descripcion' => 'Jarrón decorativo de cerámica. Puede usarse con flores secas o como decoración.',
                'precio' => 24.90,
                'stock' => 5,
                'imagen' => 'img/productos/jarrones.jpg',
                'alt' => 'Jarrones de cerámica artesanal',
            ],
            [
                'slug' => 'figura-cabezones',
                'nombre' => 'Figura decorativa',
                'categoria' => 'Decoración',
                'descripcion' => 'Figura de cerámica pintada. Producto pensado para decorar una habitación o estantería.',
                'precio' => 18.00,
                'stock' => 3,
                'imagen' => 'img/productos/cabezones.png',
                'alt' => 'Figuras decorativas de cerámica',
            ],
            [
                'slug' => 'cabeza-ceramica',
                'nombre' => 'Cabeza de cerámica',
                'categoria' => 'Decoración',
                'descripcion' => 'Pieza decorativa de cerámica con acabado artesanal.',
                'precio' => 21.75,
                'stock' => 1,
                'imagen' => 'img/productos/cabeza.jpg',
                'alt' => 'Cabeza decorativa de cerámica',
            ],
        ];
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

    public function agregarCarrito(Request $request)
    {
        $request->validate([
            'producto' => ['required'],
            'cantidad' => ['required', 'integer', 'min:1'],
        ]);

        return back()->with('mensaje', 'Producto añadido al carrito.');
    }

    public function agregarDeseo(Request $request)
    {
        $request->validate([
            'producto' => ['required'],
        ]);

        return back()->with('mensaje', 'Producto guardado en la lista de deseos.');
    }
}
