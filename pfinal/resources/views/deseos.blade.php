@extends('layouts.app')

@section('title', 'Lista de deseos - Origenia')

@section('content')
    <section class="presentacion-catalogo">
        <p class="seccion">Lista de deseos</p>
        <h1>Productos guardados</h1>
        <p>Aquí aparecen los productos que has guardado para ver más tarde.</p>
    </section>

    @if (session('mensaje'))
        <p class="aviso">{{ session('mensaje') }}</p>
    @endif

    @if (count($productos) > 0)
        <section class="listado-productos">
            @foreach ($productos as $producto)
                <article class="producto">
                    <figure class="producto-imagen">
                        <img src="{{ asset($producto['imagen']) }}" alt="{{ $producto['alt'] }}">
                    </figure>

                    <div class="producto-info">
                        <span class="categoria">{{ $producto['categoria'] }}</span>

                        <h2>{{ $producto['nombre'] }}</h2>

                        <p class="descripcion">{{ $producto['descripcion'] }}</p>

                        <p>
                            Precio:
                            <strong>{{ number_format($producto['precio'], 2, ',', '.') }} €</strong>
                        </p>

                        <div class="acciones-secundarias">
                            <a class="boton boton-secundario" href="{{ route('producto.detalle', $producto['slug']) }}">
                                Ver detalle
                            </a>

                            <form method="POST" action="{{ route('deseos.eliminar', $producto['slug']) }}">
                                @csrf
                                @method('DELETE')

                                <button class="boton boton-claro" type="submit">
                                    Quitar
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
    @else
        <section class="sin-resultados">
            <h2>No hay productos guardados</h2>
            <p>Guarda productos desde el catálogo para verlos aquí.</p>
            <a href="{{ route('catalogo') }}">Ir al catálogo</a>
        </section>
    @endif
@endsection
