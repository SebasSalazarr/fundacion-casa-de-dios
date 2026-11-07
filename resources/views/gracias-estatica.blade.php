@extends('layouts.app')

@section('titulo', 'Gracias | Fundación Casa de Dios Fuente de Agua Viva')

@section('contenido')
    <section class="seccion">
        <div class="wrap">
            <div class="panel panel--durazno resultado">
                <h1>Gracias por apoyar a la fundación</h1>
                <p>El resultado de tu pago es el que te mostró Wompi. Si tuviste algún problema, escríbenos por WhatsApp.</p>

                <div class="portada__acciones">
                    <a class="boton" href="https://wa.me/573128566550" target="_blank" rel="noopener">Escribir por WhatsApp</a>
                    <a class="boton boton--suave" href="{{ route('inicio') }}">Volver al inicio</a>
                </div>
            </div>
        </div>
    </section>
@endsection
