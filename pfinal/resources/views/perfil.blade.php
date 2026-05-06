@extends('layouts.app')

@section('title', 'Perfil - Origenia')

@section('content')
    <section class="presentacion-catalogo">
        <p class="seccion">Perfil</p>
        <h1>Área de usuario</h1>
        <p>En esta página se muestran los pedidos realizados durante la sesión.</p>
    </section>

    @if (session('mensaje'))
        <p class="aviso">{{ session('mensaje') }}</p>
    @endif

    @if (count($pedidos) > 0)
        <section class="pedidos">
            @foreach ($pedidos as $pedido)
                <article class="pedido">
                    <h2>Pedido #{{ $pedido['id'] }}</h2>

                    <p>Fecha: {{ $pedido['fecha'] }}</p>
                    <p>Estado: <strong>{{ $pedido['estado'] }}</strong></p>
                    <p>Total: <strong>{{ number_format($pedido['total'], 2, ',', '.') }} €</strong></p>

                    <h3>Productos</h3>

                    <ul>
                        @foreach ($pedido['lineas'] as $linea)
                            <li>
                                {{ $linea['producto']['nombre'] }}
                                x {{ $linea['cantidad'] }}
                                -
                                {{ number_format($linea['importe'], 2, ',', '.') }} €
                            </li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </section>
    @else
        <section class="sin-resultados">
            <h2>Todavía no hay pedidos</h2>
            <p>Cuando confirmes un pedido desde el checkout aparecerá aquí.</p>
            <a href="{{ route('catalogo') }}">Ir al catálogo</a>
        </section>
    @endif
@endsection
