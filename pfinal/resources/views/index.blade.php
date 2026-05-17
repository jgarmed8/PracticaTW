@extends('layouts.app')
@section('title', 'Inicio - Origenia')
@section('content')


<!-- HERO -->
<section class="hero">
    <div class="hero-contenido">
        <span class="hero-etiqueta">✦ Artesanía auténtica</span>
        <h1>Donde las manos<br><em>cuentan historias.</em></h1>
        <p class="hero-subtitulo">Artesanía local, sostenible y con alma. Descubre piezas únicas hechas con dedicación en nuestra región.</p>
        <div class="hero-acciones">
            <a href="{{ url('/catalogo') }}" class="boton-hero-principal">Explorar catálogo</a>
            <a href="{{ url('/artesanos') }}" class="boton-hero-secundario">Conocer artesanos</a>
        </div>
    </div>
</section>
 
<!-- PILARES -->
<div class="pilares">
    <div class="pilar">
        <div>
            <h3>Materiales Sostenibles</h3>
            <p>Seleccionamos materias primas de origen local y respetuosas con el entorno.</p>
        </div>
    </div>
    <div class="pilar">
        <div>
            <h3>Hechos a mano en nuestra región</h3>
            <p>Cada pieza es elaborada de forma artesanal por maestros locales.</p>
        </div>
    </div>
    <div class="pilar">
        <div>
            <h3>Envíos directos desde el taller</h3>
            <p>Tu pedido llega directo desde las manos de quien lo creó hasta tu puerta.</p>
        </div>
    </div>
</div>
 
<!-- CONTENIDO PRINCIPAL -->
<main class="pagina-inicio">
 
    <!-- PRODUCTOS DESTACADOS -->
    <div class="seccion-titulo">
        <span class="etiqueta-seccion">Selección</span>
        <h2>Piezas destacadas</h2>
        <p>Artículos elegidos por nuestro equipo esta temporada.</p>
    </div>
 
    <div class="productos-destacados">
        <div class="producto-mini">
            <div class="producto-mini-imagen">
                <figure class="producto-imagen">
                    <img src="img/productos/cabezones.png" alt="Cabezones">
                </figure>
            </div>
            <div class="producto-mini-info">
                <div class="producto-mini-cabecera">
                    <span class="badge-cat">Cerámica</span>
                    <span class="badge-nuevo">Novedad</span>
                </div>
                <h3>Figura decorativa</h3>
                <p>Figura de cerámica pintada. Producto pensado para decorar una habitación o estantería.</p>
                <div class="producto-mini-footer">
                    <span class="precio">18,00 €</span>
                    <a href="{{ url('/producto/figura-cabezones') }}" class="boton-ver">Ver pieza</a>
                </div>
            </div>
        </div>
  
        <div class="producto-mini">
            <div class="producto-mini-imagen">🧺</div>
            <div class="producto-mini-info">
                <div class="producto-mini-cabecera">
                    <span class="badge-cat">Textil</span>
                    <span class="badge-nuevo">Destacado</span>
                </div>
                <h3>Cesta de esparto tejida</h3>
                <p>Tejida artesanalmente con técnicas tradicionales del sur de España.</p>
                <div class="producto-mini-footer">
                    <span class="precio">24 €</span>
                    <a href="{{ url('/producto/cesta-esparto') }}" class="boton-ver">Ver pieza</a>
                </div>
            </div>
        </div>
 
        <div class="producto-mini">
            <div class="producto-mini-imagen">🪵</div>
            <div class="producto-mini-info">
                <div class="producto-mini-cabecera">
                    <span class="badge-cat">Madera</span>
                    <span class="badge-nuevo">Limitado</span>
                </div>
                <h3>Cuenco de olivo</h3>
                <p>Tallado a mano en madera de olivo centenario. Pieza única con certificado.</p>
                <div class="producto-mini-footer">
                    <span class="precio">55 €</span>
                    <a href="{{ url('/producto/cuenco-olivo') }}" class="boton-ver">Ver pieza</a>
                </div>
            </div>
        </div>
    </div>
 
    <div class="ver-todos">
        <a href="{{ url('/catalogo') }}" class="boton-ver-todos">Ver todo el catálogo →</a>
    </div>
 
    <!-- BANNER ARTESANOS -->
    <div class="banner-artesanos">
        <div>
            <h2>¿Eres artesano o artesana?</h2>
            <p>Únete a nuestra comunidad de creadores locales y lleva tus piezas a miles de personas que valoran lo hecho a mano. Sin intermediarios, sin complicaciones.</p>
        </div>
        <a href="{{ url('/artesanos/registro') }}" class="boton-banner">Empieza a vender</a>
    </div>
 
    <!-- VALORES -->
    <div class="seccion-titulo">
        <span class="etiqueta-seccion">Por qué Origenia</span>
        <h2>Nuestro compromiso</h2>
    </div>
 
    <div class="valores">
        <div class="valor">
            <span class="valor-icono">🌱</span>
            <h3>Sostenibilidad</h3>
            <p>Trabajamos solo con artesanos que utilizan materiales responsables y procesos respetuosos con el medio ambiente.</p>
        </div>
        <div class="valor">
            <span class="valor-icono">🏡</span>
            <h3>Economía local</h3>
            <p>Cada compra apoya directamente a creadores de nuestra región, fortaleciendo el tejido cultural y económico local.</p>
        </div>
        <div class="valor">
            <span class="valor-icono">✨</span>
            <h3>Unicidad garantizada</h3>
            <p>Cada pieza es diferente. No encontrarás dos iguales: eso es precisamente lo que hace especial a la artesanía.</p>
        </div>
    </div>
 
</main>
 
<!-- PIE -->
<footer class="pie">
    <p>© 2025 Origenia · Artesanía local y sostenible · <a href="{{ url('/contacto') }}">Contacto</a> · <a href="{{ url('/privacidad') }}">Privacidad</a></p>
</footer>
 @endsection

