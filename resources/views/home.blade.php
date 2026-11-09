@extends('layouts.app')

@section('contenido')
    <div class="wrap portada">
        <div class="portada__texto">
            <h1>
                @foreach (explode(' ', 'Fundación cristiana para niños y familias en Turbo, Antioquia') as $i => $palabra)
                    <span class="palabra" style="--i: {{ $i }}">{{ $palabra }}</span>
                @endforeach
            </h1>
            <p class="portada__entrada">Donde la fe se convierte en alimento, educación y esperanza para quienes más lo necesitan.</p>
            <div class="portada__acciones">
                <a class="boton" href="#donar">Donar ahora</a>
                <a class="boton boton--suave" href="#quienes">Conocer la fundación</a>
            </div>
        </div>

        <div class="collage">
            <figure class="foto">
                @include('partials.foto', [
                    'id' => 'e7',
                    'prioridad' => true,
                    'sizes' => '(min-width: 960px) 56vw, 100vw',
                    'alt' => 'Niños de la fundación en Turbo, de pie y tomados de la mano, algunos con trajes de médico y enfermera.',
                ])
            </figure>
            <figure class="foto">
                @include('partials.foto', [
                    'id' => 'e39',
                    'sizes' => '28vw',
                    'alt' => 'Una voluntaria abraza a una niña que recibe su bolsa de regalos en Navidad.',
                ])
            </figure>
            <figure class="foto">
                @include('partials.foto', [
                    'id' => 'e58',
                    'sizes' => '28vw',
                    'alt' => 'Niñas muestran sus regalos junto a una voluntaria, frente al pendón de la fundación.',
                ])
            </figure>
        </div>
    </div>

    <section class="seccion" id="quienes" aria-labelledby="t-quienes">
        <div class="wrap quienes">
            <h2 id="t-quienes">Quiénes somos</h2>
            <p class="entrada">La Fundación Casa de Dios Fuente de Agua Viva es una entidad sin ánimo de lucro de Turbo, Antioquia. Trabajamos con niños, adolescentes, jóvenes, familias y comunidades.</p>
        </div>
        <div class="wrap">
            <figure class="foto foto--ancha paralaje">
                @include('partials.foto', [
                    'id' => 'e59',
                    'sizes' => '(min-width: 1336px) 1240px, 100vw',
                    'alt' => 'El equipo de la fundación, con camisetas rojas, reunido en su salón de madera bajo el letrero Jesucristo es el Señor.',
                ])
            </figure>
        </div>
    </section>

    <section class="seccion seccion--sin-arriba" id="que-hacemos" aria-labelledby="t-hacemos">
        <div class="wrap">
            <div class="panel panel--durazno objetivos">
                <div class="objetivos__texto">
                    <h2 id="t-hacemos">Qué hacemos</h2>
                    <p class="quehacemos__entrada">Entrega de ayudas humanitarias, jornadas comunitarias y apoyo a familias vulnerables.</p>
                    <h3 class="lista__titulo">Nuestros objetivos</h3>
                    <ul class="lista">
                        <li>Crear centros de educación para niños, adolescentes y jóvenes con formación en valores éticos y principios cristianos.</li>
                        <li>Complementar una adecuada alimentación nutricional mediante comedores escolares y comunitarios.</li>
                        <li>Brindar programas de rehabilitación para personas en situación de riesgo y marginación social.</li>
                        <li>Brindar asesoría y capacitaciones en proyectos productivos que faciliten la generación de empleo.</li>
                    </ul>
                </div>
                <figure class="foto objetivos__alta paralaje">
                    @include('partials.foto', [
                        'id' => 'e63',
                        'sizes' => '(min-width: 960px) 34vw, 100vw',
                        'alt' => 'Salón con techo de zinc: el equipo prepara comida en una olla mientras niños y madres esperan sentados.',
                    ])
                </figure>
                <figure class="foto objetivos__ancha paralaje">
                    @include('partials.foto', [
                        'id' => 'e66',
                        'sizes' => '(min-width: 960px) 56vw, 100vw',
                        'alt' => 'Una mujer habla de pie en el centro de un círculo de niños sentados en sillas plásticas de colores.',
                    ])
                </figure>
            </div>
        </div>
    </section>

    <section class="seccion seccion--sin-arriba" id="mision" aria-label="Misión y visión">
        <div class="wrap">
            <div class="panel panel--cielo mision">
                <div>
                    <h2>Misión</h2>
                    <p>Promover el derecho de toda persona, especialmente la infancia y la juventud, por medio de proyectos que propicien la formación en principios cristianos, de forma equitativa y beneficiosa para la sociedad, contribuyendo así a mejorar su calidad de vida.</p>
                </div>
                <div>
                    <h2>Visión</h2>
                    <p>Trabajar con niños, adolescentes, jóvenes, familias y comunidades, brindándoles las herramientas necesarias a través de la educación bajo principios morales y valores cristianos, contribuyendo a mejorar su calidad de vida, desarrollar su potencial y participar de manera activa y responsable dentro de la sociedad.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="seccion seccion--sin-arriba" id="ubicacion" aria-labelledby="t-ubicacion">
        <div class="wrap ubicacion">
            <div>
                <h2 id="t-ubicacion">Dónde estamos</h2>
                <address>Calle 99 #15-95<br>Turbo, Antioquia</address>
                <div class="ubicacion__enlaces">
                    <a class="enlace" href="https://wa.me/573128566550" target="_blank" rel="noopener">
                        @include('partials.icon-whatsapp')
                        Escribir por WhatsApp
                    </a>
                    <a class="enlace" href="https://www.facebook.com/profile.php?id=100083337127889" target="_blank" rel="noopener">
                        @include('partials.icon-facebook')
                        Ver en Facebook
                    </a>
                </div>
            </div>
            <iframe
                title="Mapa de la fundación en Turbo, Antioquia"
                src="https://www.google.com/maps?q=Cl.%2099%20%2315-95%2C%20Turbo%2C%20Antioquia&output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </section>

    <section class="seccion seccion--sin-arriba" id="fotos" aria-labelledby="t-fotos">
        <div class="wrap">
            <div class="fotos__cabecera">
                <h2 id="t-fotos">Fotos de nuestro trabajo</h2>
                <a class="boton boton--suave boton--chico" href="{{ route('fotos') }}">Ver todas las fotos</a>
            </div>
            <div class="mosaico">
                @foreach ([
                    ['e62', 'Niños con sus regalos junto al equipo, frente al pendón azul de la fundación.'],
                    ['e47', 'Una niña recibe su bolsa amarilla de regalos en la celebración de Navidad.'],
                    ['e3', 'Voluntarias de camiseta roja junto a una mesa con ayudas para entregar.'],
                    ['e15', 'Salón lleno de familias aplaudiendo durante la celebración de Navidad.'],
                    ['e55', 'Niños mostrando sus regalos con dos voluntarias sonrientes.'],
                    ['e50', 'Niños y madres sentados en el salón durante una jornada, con el equipo acompañando.'],
                    ['e64', 'Decenas de niños con globos frente a un salón de madera.'],
                ] as [$foto, $descripcion])
                    <figure class="foto">
                        <a href="{{ asset("img/web/{$foto}-1600.webp") }}" data-foto>
                            @include('partials.foto', ['id' => $foto, 'sizes' => '(min-width: 600px) 33vw, 50vw', 'alt' => $descripcion])
                        </a>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    <section class="seccion seccion--sin-arriba" id="video" aria-labelledby="t-video">
        <div class="wrap video">
            <h2 id="t-video">Video institucional</h2>
            <video controls preload="none" playsinline poster="{{ asset('img/web/video-portada.webp') }}">
                <source src="{{ asset('img/ee.mp4') }}" type="video/mp4">
                <a href="{{ asset('img/ee.mp4') }}">Descargar el video</a>
            </video>
        </div>
    </section>

    <section class="seccion seccion--sin-arriba" id="historias" aria-labelledby="t-historias">
        <div class="wrap">
            <div class="panel panel--cielo historias">
                <h2 id="t-historias">Historias que inspiran</h2>
                <blockquote class="historias__grande">“Gracias a la fundación hoy puedo estudiar y soñar con un mejor futuro.”</blockquote>
                <figure class="foto historias__foto paralaje">
                    @include('partials.foto', [
                        'id' => 'e8',
                        'sizes' => '(min-width: 960px) 34vw, 100vw',
                        'alt' => 'Una voluntaria sonríe junto a una niña vestida de enfermera que muestra su cartel: Mañana será bonito.',
                    ])
                </figure>
                <blockquote class="historias__otra">“Aquí encontré alimento, educación y amor.”</blockquote>
            </div>
        </div>
    </section>

    <section class="seccion seccion--sin-arriba" id="valores" aria-labelledby="t-valores">
        <div class="wrap valores">
            <h2 id="t-valores">Nuestros valores</h2>
            <dl>
                @foreach ([
                    'Compromiso' => 'Observación social y respuestas ajustadas, efectivas y continuas.',
                    'Integración' => 'Soluciones coordinadas entre servicios y fuentes de apoyo.',
                    'Flexibilidad' => 'Adaptación a las diferentes situaciones y necesidades.',
                    'Responsabilidad' => 'Decisiones conscientes y asumidas con seriedad.',
                    'Transparencia' => 'Claridad, honestidad y coherencia ante la sociedad.',
                    'Tolerancia' => 'Respeto por las ideas y opiniones de los demás.',
                    'Humanidad' => 'Acciones humanas, empáticas y solidarias.',
                ] as $valor => $significado)
                    <div>
                        <dt>{{ $valor }}</dt>
                        <dd>{{ $significado }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    <section class="seccion seccion--sin-arriba" aria-labelledby="t-donar">
        <div class="wrap">
            <div class="panel panel--durazno cierre">
                <div>
                    <h2 id="t-donar">Ayúdanos a seguir cambiando vidas</h2>
                    <p>Tu donación permite brindar alimentación, educación y esperanza a muchas familias. Cada aporte cuenta.</p>
                </div>
                @include('partials.donar', ['id' => 'donar'])
            </div>
        </div>
    </section>
@endsection
