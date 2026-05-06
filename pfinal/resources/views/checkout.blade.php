@extends('layouts.app')

@section('title', 'Checkout - Origenia')

@section('content')
    <section class="presentacion-catalogo">
        <p class="seccion">Checkout</p>
        <h1>Finalizar pedido</h1>
        <p>Introduce los datos de envío para confirmar el pedido simulado.</p>
    </section>

    <section class="checkout">
        <form method="POST" action="{{ route('checkout.confirmar') }}" class="formulario-checkout">
            @csrf

            <div class="campo">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="campo">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="campo">
                <label for="direccion">Dirección de envío</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
            </div>

            <button class="boton boton-principal" type="submit">
                Confirmar pedido
            </button>
        </form>

        <aside class="resumen-pedido">
            <h2>Resumen</h2>
            <p>Subtotal: <strong>{{ number_format($subtotal, 2, ',', '.') }} €</strong></p>
            <p>Descuento: <strong>{{ number_format($descuento, 2, ',', '.') }} €</strong></p>
            <p>Total: <strong>{{ number_format($total, 2, ',', '.') }} €</strong></p>
        </aside>
    </section>
@endsection
