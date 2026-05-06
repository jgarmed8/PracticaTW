<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeseosController extends Controller
{
    private function productoPorSlug($slug)
    {
        return collect(config('productos'))->firstWhere('slug', $slug);
    }

    public function index()
    {
        $deseos = session('deseos', []);
        $productos = [];

        foreach ($deseos as $slug) {
            $producto = $this->productoPorSlug($slug);

            if ($producto) {
                $productos[] = $producto;
            }
        }

        return view('deseos', [
            'productos' => $productos,
        ]);
    }

    public function agregar(Request $request)
    {
        $request->validate([
            'producto' => ['required'],
        ]);

        $producto = $this->productoPorSlug($request->producto);

        if (!$producto) {
            return back()->with('mensaje', 'El producto no existe.');
        }

        $deseos = session('deseos', []);

        if (!in_array($producto['slug'], $deseos)) {
            $deseos[] = $producto['slug'];
        }

        session(['deseos' => $deseos]);

        return back()->with('mensaje', 'Producto guardado en la lista de deseos.');
    }

    public function eliminar($slug)
    {
        $deseos = session('deseos', []);
        $deseos = array_filter($deseos, function ($item) use ($slug) {
            return $item !== $slug;
        });

        session(['deseos' => $deseos]);

        return redirect()->route('deseos')->with('mensaje', 'Producto eliminado de la lista de deseos.');
    }
}
