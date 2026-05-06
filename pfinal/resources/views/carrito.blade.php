@extends('layouts.app')

@section('title', 'Carrito - Origenia')

@section('content')
    <section class="presentacion-catalogo">
        <p class="seccion">Carrito</p>
        <h1>Carrito de compra</h1>
        <p>Revisa los productos añadidos antes de continuar con el pedido.</p>
    </section>

    @if (session('mensaje'))
        <p class="aviso">{{ session('mensaje') }}</p>
    @endif

    @if (count($lineas) > 0)
        <form method="POST" action="{{ route('carrito.actualizar') }}" class="caja">
            @csrf
            @method('PUT')

            @foreach ($lineas as $linea)
                <article class="linea-carrito">
                    <img src="{{ asset($linea['producto']['imagen']) }}" alt="{{ $linea['producto']['alt'] }}">

                    <div>
                        <h2>{{ $linea['producto']['nombre'] }}</h2>
                        <p>{{ $linea['producto']['descripcion'] }}</p>
                        <p>Precio: <strong>{{ number_format($linea['producto']['precio'], 2, ',', '.') }} €</strong></p>
                    </div>

                    <div>
                        <label for="cantidad-{{ $linea['producto']['slug'] }}">Cantidad</label>
                        <input
                            type="number"
                            id="cantidad-{{ $linea['producto']['slug'] }}"
                            name="cantidades[{{ $linea['producto']['slug'] }}]"
                            value="{{ $linea['cantidad'] }}"
                            min="1"
                            max="{{ $linea['producto']['stock'] }}"
                        >

                        <p>
                            Importe:
                            <strong>{{ number_format($linea['importe'], 2, ',', '.') }} €</strong>
                        </p>
                    </div>

                    <div>
                        <button class="boton boton-principal" type="submit">
                            Actualizar
                        </button>
                    </div>
                </article>
            @endforeach
        </form>

        <section class="resumen-pedido">
            <p>Subtotal: <strong>{{ number_format($subtotal, 2, ',', '.') }} €</strong></p>
            <p>Descuento: <strong>{{ number_format($descuento, 2, ',', '.') }} €</strong></p>
            <p>Total: <strong>{{ number_format($total, 2, ',', '.') }} €</strong></p>

            <div class="acciones-carrito">
                <a class="boton boton-principal" href="{{ route('checkout') }}">
                    Continuar al checkout
                </a>

                <form method="POST" action="{{ route('carrito.vaciar') }}">
                    @csrf
                    @method('DELETE')

                    <button class="boton boton-secundario" type="submit">
                        Vaciar carrito
                    </button>
                </form>
            </div>
        </section>
    @else
        <section class="sin-resultados">
            <h2>El carrito está vacío</h2>
            <p>Añade algún producto desde el catálogo para poder hacer el pedido.</p>
            <a href="{{ route('catalogo') }}">Ir al catálogo</a>
        </section>
    @endif
@endsection
