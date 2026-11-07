<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Fundación Casa de Dios Fuente de Agua Viva | Turbo, Antioquia')</title>
    <meta name="description" content="Fundación cristiana sin ánimo de lucro que acompaña a niños, jóvenes y familias en Turbo, Antioquia. Dona desde tu celular.">
    <meta name="theme-color" content="#FBF7F0">
    <link rel="icon" href="{{ asset('img/logo.jpeg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="saltar" href="#contenido">Saltar al contenido</a>

    <header class="cabecera">
        <div class="wrap cabecera__fila">
            <a class="marca" href="{{ route('inicio') }}">
                <img src="{{ asset('img/web/logo-240.webp') }}" width="240" height="165" alt="">
                <span>Fundación Casa de Dios<small>Fuente de Agua Viva</small></span>
            </a>

            <button class="cabecera__menu" type="button" aria-expanded="false" aria-controls="menu" data-menu>Menú</button>

            <nav class="menu" id="menu" aria-label="Principal">
                <a href="{{ route('inicio') }}#quienes">Quiénes somos</a>
                <a href="{{ route('inicio') }}#que-hacemos">Qué hacemos</a>
                <a href="{{ route('inicio') }}#ubicacion">Ubicación</a>
                <a href="{{ route('fotos') }}">Fotos</a>
                <a class="boton boton--chico" href="{{ route('inicio') }}#donar">Donar ahora</a>
            </nav>
        </div>
    </header>

    <main id="contenido">
        @yield('contenido')
    </main>

    <footer class="pie">
        <div class="wrap">© {{ date('Y') }} Fundación Casa de Dios Fuente de Agua Viva · Todos los derechos reservados</div>
    </footer>

    <div class="barra" data-barra>
        <a class="boton" href="{{ route('inicio') }}#donar">Donar ahora</a>
        <a class="barra__whatsapp" href="https://wa.me/573128566550" target="_blank" rel="noopener" aria-label="Escribir por WhatsApp">
            @include('partials.icon-whatsapp')
        </a>
    </div>

    <dialog class="visor" aria-label="Visor de fotos" data-visor>
        <div class="visor__barra">
            <span data-contador aria-live="polite"></span>
            <button type="button" aria-label="Cerrar" data-cerrar>
                <svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
        </div>
        <img src="data:," alt="">
        <div class="visor__pasos">
            <button type="button" aria-label="Foto anterior" data-anterior>
                <svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7"/></svg>
            </button>
            <button type="button" aria-label="Foto siguiente" data-siguiente>
                <svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </dialog>
</body>
</html>
