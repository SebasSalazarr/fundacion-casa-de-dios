@php
    // Tamaño real de cada foto en public/img/web (las de menos de 1600 no se amplían).
    [$ancho, $alto] = [
        'e7' => [1600, 1200], 'e8' => [1200, 1600], 'e59' => [1280, 960], 'e66' => [1280, 960],
        'e3' => [1280, 960], 'e15' => [1280, 960], 'e62' => [1280, 960], 'e63' => [958, 1280],
        'e47' => [960, 1280], 'e39' => [960, 1280], 'e58' => [960, 1280], 'e50' => [960, 1280], 'e55' => [960, 1280], 'e64' => [958, 1280],
    ][$id];
@endphp
<img
    src="{{ asset("img/web/{$id}-800.webp") }}"
    srcset="{{ asset("img/web/{$id}-800.webp") }} 800w, {{ asset("img/web/{$id}-1600.webp") }} {{ $ancho }}w"
    sizes="{{ $sizes ?? '100vw' }}"
    width="{{ $ancho }}" height="{{ $alto }}"
    alt="{{ $alt }}"
    @if ($prioridad ?? false) fetchpriority="high" @else loading="lazy" @endif
    decoding="async"
>
