@extends('layouts.app')

@section('titulo', 'Tu donación | Fundación Casa de Dios Fuente de Agua Viva')

@section('contenido')
    @php
        $pesos = '$'.number_format($donacion->monto, 0, ',', '.');
    @endphp

    <section class="seccion">
        <div class="wrap">
            <div class="panel panel--durazno resultado">
                @switch($donacion->estado)
                    @case(\App\Models\Donacion::APROBADO)
                        <h1>Gracias por tu donación</h1>
                        <p>Recibimos tu aporte de {{ $pesos }}. Tu ayuda llega a niños y familias en Turbo.</p>
                        @break

                    @case(\App\Models\Donacion::RECHAZADO)
                        <h1>El pago no se completó</h1>
                        <p>Tu aporte de {{ $pesos }} no se procesó. Puedes intentarlo de nuevo cuando quieras.</p>
                        @break

                    @default
                        <h1>Estamos confirmando tu pago</h1>
                        <p>Wompi nos avisará el resultado de tu aporte de {{ $pesos }}. Puede tardar unos minutos; recarga esta página para ver si ya se confirmó.</p>
                @endswitch

                <p class="resultado__referencia">Referencia: {{ $donacion->referencia }}</p>

                <div class="portada__acciones">
                    @if ($donacion->estado === \App\Models\Donacion::RECHAZADO)
                        <a class="boton" href="{{ route('inicio') }}#donar">Intentar de nuevo</a>
                    @endif
                    <a class="boton boton--suave" href="{{ route('inicio') }}">Volver al inicio</a>
                </div>
            </div>
        </div>
    </section>
@endsection
