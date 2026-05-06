<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    private function productos()
    {
        return collect(config('productos'));
    }

    private function productoPorSlug($slug)
    {
        return $this->productos()->firstWhere('slug', $slug);
    }

    private function resumenCarrito()
    {
        $carrito = session('carrito', []);
        $lineas = [];
        $subtotal = 0;

        foreach ($carrito as $slug => $cantidad) {
            $producto = $this->productoPorSlug($slug);

            if ($producto) {
                $importe = $producto['precio'] * $cantidad;
                $subtotal += $importe;

                $lineas[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'importe' => $importe,
                ];
            }
        }

        $descuento = 0;

        if ($subtotal >= 50) {
            $descuento = $subtotal * 0.10;
        }

        $total = $subtotal - $descuento;

        return [
            'lineas' => $lineas,
            'subtotal' => $subtotal,
            'descuento' => $descuento,
            'total' => $total,
        ];
    }

    public function index()
    {
        return view('carrito', $this->resumenCarrito());
    }

    public function agregar(Request $request)
    {
        $request->validate([
            'producto' => ['required'],
            'cantidad' => ['required', 'integer', 'min:1'],
        ]);

        $producto = $this->productoPorSlug($request->producto);

        if (!$producto) {
            return back()->with('mensaje', 'El producto no existe.');
        }

        $carrito = session('carrito', []);
        $cantidadActual = $carrito[$producto['slug']] ?? 0;
        $cantidadNueva = $cantidadActual + (int) $request->cantidad;

        if ($cantidadNueva > $producto['stock']) {
            return back()->with('mensaje', 'No hay suficiente stock disponible.');
        }

        $carrito[$producto['slug']] = $cantidadNueva;
        session(['carrito' => $carrito]);

        return back()->with('mensaje', 'Producto añadido al carrito.');
    }

    public function actualizar(Request $request)
    {
        $cantidades = $request->input('cantidades', []);
        $carrito = [];

        foreach ($cantidades as $slug => $cantidad) {
            $producto = $this->productoPorSlug($slug);
            $cantidad = (int) $cantidad;

            if ($producto && $cantidad > 0) {
                if ($cantidad > $producto['stock']) {
                    $cantidad = $producto['stock'];
                }

                $carrito[$slug] = $cantidad;
            }
        }

        session(['carrito' => $carrito]);

        return redirect()->route('carrito')->with('mensaje', 'Carrito actualizado.');
    }

    public function eliminar($slug)
    {
        $carrito = session('carrito', []);

        unset($carrito[$slug]);

        session(['carrito' => $carrito]);

        return redirect()->route('carrito')->with('mensaje', 'Producto eliminado del carrito.');
    }

    public function vaciar()
    {
        session()->forget('carrito');

        return redirect()->route('carrito')->with('mensaje', 'Carrito vaciado.');
    }

    public function checkout()
    {
        $resumen = $this->resumenCarrito();

        if (count($resumen['lineas']) === 0) {
            return redirect()->route('carrito')->with('mensaje', 'El carrito está vacío.');
        }

        return view('checkout', $resumen);
    }

    public function confirmar(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'direccion' => ['required', 'min:5'],
        ]);

        $resumen = $this->resumenCarrito();

        if (count($resumen['lineas']) === 0) {
            return redirect()->route('carrito')->with('mensaje', 'No se puede confirmar un pedido vacío.');
        }

        $pedidos = session('pedidos', []);

        $pedidos[] = [
            'id' => count($pedidos) + 1,
            'fecha' => now()->format('d/m/Y H:i'),
            'nombre' => $request->nombre,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'lineas' => $resumen['lineas'],
            'subtotal' => $resumen['subtotal'],
            'descuento' => $resumen['descuento'],
            'total' => $resumen['total'],
            'estado' => 'Pendiente',
        ];

        session(['pedidos' => $pedidos]);
        session()->forget('carrito');

        return redirect()->route('perfil')->with('mensaje', 'Pedido realizado correctamente.');
    }
}
