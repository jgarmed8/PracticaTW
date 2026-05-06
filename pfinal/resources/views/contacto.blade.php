@extends('layouts.app')
@section('title', 'Contacto - Arcilla Viva')
@section('content')

<section class="presentacion-contacto">
    <h1>Contacto</h1>
    <p>Puedes contactar con nosotros a través de este formulario.</p>
</section>

<section class="formulario-contacto">
    <form method="POST" action="#">

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                class="w-64"
                required
                minlength="3"
                maxlength="50"
                pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                title="Solo letras y espacios (mínimo 3 caracteres)"
            >
        </div>

        <div class="campo">
            <label for="email">Correo</label>
            <input
                type="email"
                id="email"
                name="email"
                class="w-64"
                required
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="Introduce un correo válido (ejemplo: usuario@dominio.com)"
            >
        </div>

        <div class="campo">
            <label for="mensaje">Mensaje</label>
            <textarea
                id="mensaje"
                name="mensaje"
                class="w-full h-40"
                required
                minlength="10"
                maxlength="500"
                title="El mensaje debe tener entre 10 y 500 caracteres"
            ></textarea>
        </div>

        <button type="submit">Enviar</button>
    </form>
</section>

@endsection