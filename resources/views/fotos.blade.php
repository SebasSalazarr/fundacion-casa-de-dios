@extends('layouts.app')

@section('titulo', 'Fotos | Fundación Casa de Dios Fuente de Agua Viva')

@section('contenido')
    @php
        // e5, e21, e49 y e52 son copias exactas de otras fotos.
        $fotos = array_values(array_diff(range(1, 66), [5, 21, 49, 52]));
    @endphp

    <section class="seccion" aria-labelledby="t-fotos">
        <div class="wrap">
            <h1 id="t-fotos">Fotos de nuestro trabajo</h1>
            <p class="entrada">Entregas de ayudas, jornadas comunitarias y celebraciones con niños y familias en Turbo. Toca una foto para verla en grande.</p>

            <div class="galeria">
                @foreach ($fotos as $numero => $foto)
                    <figure class="foto">
                        <a href="{{ asset("img/web/e{$foto}-1600.webp") }}" data-foto>
                            <img
                                src="{{ asset("img/web/e{$foto}-480.webp") }}"
                                width="480" height="480"
                                alt="Foto {{ $numero + 1 }} de las actividades de la fundación en Turbo."
                                loading="lazy" decoding="async"
                            >
                        </a>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
@endsection
