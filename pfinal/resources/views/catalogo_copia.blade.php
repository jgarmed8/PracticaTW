@extends('layouts.app')

@section('title', 'Catálogo - Arcilla Viva')

@section('content')
    <section class="presentacion-catalogo">
        <p class="seccion">Catálogo</p>

        <h1>Cerámicas disponibles</h1>

        <p>
            En esta sección se muestran los productos de la tienda.
            Hay tazas, jarrones y piezas decorativas de cerámica, con su precio y stock.
        </p>
    </section>

    @if (session('mensaje'))
        <p class="aviso">{{ session('mensaje') }}</p>
    @endif

    <section class="filtros" aria-label="Filtros del catálogo">
        <form method="GET" action="{{ route('catalogo') }}">
            <div class="campo">
                <label for="busqueda">Buscar</label>
                <input
                    type="search"
                    id="busqueda"
                    name="busqueda"
                    value="{{ $busqueda }}"
                    placeholder="taza, jarrón..."
                >
            </div>

            <div class="campo">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria">
                    <option value="">Todas</option>
                    <option value="Tazas" @selected($categoriaSeleccionada === 'Tazas')>Tazas</option>
                    <option value="Jarrones" @selected($categoriaSeleccionada === 'Jarrones')>Jarrones</option>
                    <option value="Decoración" @selected($categoriaSeleccionada === 'Decoración')>Decoración</option>
                </select>
            </div>

            <div class="campo">
                <label for="orden">Ordenar por</label>
                <select id="orden" name="orden">
                    <option value="">Sin ordenar</option>
                    <option value="precio_asc" @selected($ordenSeleccionado === 'precio_asc')>
                        Precio menor
                    </option>
                    <option value="precio_desc" @selected($ordenSeleccionado === 'precio_desc')>
                        Precio mayor
                    </option>
                    <option value="stock_desc" @selected($ordenSeleccionado === 'stock_desc')>
                        Más stock
                    </option>
                </select>
            </div>

            <button type="submit">Filtrar</button>
        </form>
    </section>

    <section class="resumen-catalogo" aria-label="Resumen del catálogo">
        <p>
            Productos encontrados:
            <strong>{{ count($productos) }}</strong>
        </p>

        <p>
            Descuento en checkout:
            <strong>10% desde 50 €</strong>
        </p>
    </section>

    <section class="listado-productos" aria-label="Listado de productos">
        @forelse ($productos as $producto)
            <article class="producto">
                <figure class="producto-imagen">
                    <img src="{{ asset($producto['imagen']) }}" alt="{{ $producto['alt'] }}">
                </figure>

                <div class="producto-info">
                    <div class="producto-cabecera">
                        <span class="categoria">{{ $producto['categoria'] }}</span>

                        @if ($producto['stock'] <= 2)
                            <span class="etiqueta">Pocas unidades</span>
                        @else
                            <span class="etiqueta">Disponible</span>
                        @endif
                    </div>

                    <h2>{{ $producto['nombre'] }}</h2>

                    <p class="descripcion">
                        {{ $producto['descripcion'] }}
                    </p>

                    <div class="datos-producto">
                        <p>
                            <span>Precio</span>
                            <strong>{{ number_format($producto['precio'], 2, ',', '.') }} €</strong>
                        </p>

                        <p>
                            <span>Stock</span>

                            @if ($producto['stock'] > 2)
                                <strong class="stock-ok">{{ $producto['stock'] }} unidades</strong>
                            @elseif ($producto['stock'] > 0)
                                <strong class="stock-bajo">{{ $producto['stock'] }} unidad</strong>
                            @else
                                <strong class="stock-agotado">Sin stock</strong>
                            @endif
                        </p>
                    </div>

                    <div class="acciones-secundarias">
                        <a class="boton boton-secundario" href="{{ route('producto.detalle', $producto['slug']) }}">
                            Ver detalle
                        </a>

                        <form method="POST" action="{{ route('deseos.agregar') }}">
                            @csrf
                            <input type="hidden" name="producto" value="{{ $producto['slug'] }}">

                            <button class="boton boton-claro" type="submit">
                                Guardar
                            </button>
                        </form>
                    </div>

                    <form class="form-compra" method="POST" action="{{ route('carrito.agregar') }}">
                        @csrf

                        <input type="hidden" name="producto" value="{{ $producto['slug'] }}">

                        <label for="cantidad-{{ $producto['slug'] }}">Cantidad</label>

                        <input
                            type="number"
                            id="cantidad-{{ $producto['slug'] }}"
                            name="cantidad"
                            value="1"
                            min="1"
                            max="{{ $producto['stock'] }}"
                            required
                            @disabled($producto['stock'] === 0)
                        >

                        <button
                            class="boton boton-principal"
                            type="submit"
                            @disabled($producto['stock'] === 0)
                        >
                            Añadir al carrito
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <article class="sin-resultados">
                <h2>No se han encontrado productos</h2>
                <p>Prueba con otra búsqueda o vuelve al catálogo completo.</p>
                <a href="{{ route('catalogo') }}">Ver todo el catálogo</a>
            </article>
        @endforelse
    </section>
@endsection