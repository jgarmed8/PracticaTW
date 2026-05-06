@extends('layouts.app')

@section('title', $producto['nombre'] . ' - Origenia')

@section('content')
    <article class="detalle-producto">
        <figure class="detalle-imagen">
            <img src="{{ asset($producto['imagen']) }}" alt="{{ $producto['alt'] }}">
        </figure>

        <section class="detalle-info">
            <p class="seccion">{{ $producto['categoria'] }}</p>

            <h1>{{ $producto['nombre'] }}</h1>

            <p>{{ $producto['descripcion'] }}</p>

            <p class="precio-detalle">
                {{ number_format($producto['precio'], 2, ',', '.') }} €
            </p>

            <p>
                Stock disponible:
                <strong>{{ $producto['stock'] }} unidades</strong>
            </p>

            <form class="form-compra" method="POST" action="{{ route('carrito.agregar') }}">
                @csrf

                <input type="hidden" name="producto" value="{{ $producto['slug'] }}">

                <label for="cantidad">Cantidad</label>

                <input
                    type="number"
                    id="cantidad"
                    name="cantidad"
                    value="1"
                    min="1"
                    max="{{ $producto['stock'] }}"
                    required
                >

                <button class="boton boton-principal" type="submit">
                    Añadir al carrito
                </button>
            </form>

            <p>
                <a href="{{ route('catalogo') }}">Volver al catálogo</a>
            </p>
        </section>
    </article>
@endsection
