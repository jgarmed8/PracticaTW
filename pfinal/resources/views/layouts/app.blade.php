<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Tienda online de cerámica artesanal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Origenia')</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <header class="cabecera">
        <div class="cabecera-contenido">
            <div>
                <a class="marca" href="{{ route('inicio') }}">Origenia</a>
                <p>Cerámica artesanal</p>
            </div>

            <div class="usuario">
                Usuario no identificado
            </div>
        </div>

        <nav class="menu" aria-label="Menú principal">
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="{{ route('catalogo') }}">Catálogo</a>
            <a href="#">Carrito</a>
            <a href="#">Perfil</a>
            <a href="{{ route('contacto') }}">Contacto</a>
        </nav>
    </header>

    <div class="pagina">
        <aside class="lateral" aria-label="Menú lateral">
            <section>
                <h2>Categorías</h2>
                <ul>
                    <li><a href="{{ route('catalogo') }}">Todas</a></li>
                    <li><a href="{{ route('catalogo', ['categoria' => 'Tazas']) }}">Tazas</a></li>
                    <li><a href="{{ route('catalogo', ['categoria' => 'Jarrones']) }}">Jarrones</a></li>
                    <li><a href="{{ route('catalogo', ['categoria' => 'Decoración']) }}">Decoración</a></li>
                </ul>
            </section>

            <section>
                <h2>Información</h2>
                <ul>
                    <li>Carrito simulado</li>
                    <li>Stock limitado</li>
                    <li>10% desde 50 €</li>
                    <li>Piezas artesanales</li>
                </ul>
            </section>
        </aside>

        <main class="contenido">
            @yield('content')
        </main>
    </div>

    <footer class="pie">
        <p>Origenia - Tienda online de cerámicas artesanales</p>
        <p>
            <a href="{{ route('contacto') }}">Contacto</a>
            <span>|</span>
            <a href="{{ asset('como_se_hizo.pdf') }}">Informe de la práctica</a>
        </p>
    </footer>
</body>
</html>
