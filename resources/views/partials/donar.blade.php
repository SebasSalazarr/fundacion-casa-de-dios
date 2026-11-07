@php
    $montos = config('services.wompi.montos');
    $elegido = 20000;
    $pesos = fn (int $monto) => '$'.number_format($monto, 0, ',', '.');
    $estatico = config('services.wompi.estatico');
    $enPrueba = $estatico ? config('services.wompi.aviso_prueba') : app(\App\Services\Wompi::class)->enPrueba();
@endphp
<form class="donar" id="{{ $id }}" action="{{ $estatico ? '/donar' : route('donar') }}" method="{{ $estatico ? 'get' : 'post' }}" data-donar>
    @unless ($estatico)
        @csrf
    @endunless
    <fieldset>
        <legend>Elige tu aporte</legend>
        <div class="donar__opciones">
            @foreach ($montos as $monto)
                <label class="monto">
                    <input type="radio" name="monto" value="{{ $monto }}" data-pesos="{{ $pesos($monto) }}" @checked($monto === $elegido)>
                    <span>{{ $pesos($monto) }}</span>
                </label>
            @endforeach
        </div>
    </fieldset>

    <button class="boton" type="submit">Donar <output class="donar__monto" data-monto>{{ $pesos($elegido) }}</output></button>

    <p class="donar__nota">
        Donación voluntaria. Pago seguro con Wompi.
        @if ($enPrueba)
            <strong>Modo de prueba: por ahora no se cobra dinero real.</strong>
        @endif
    </p>
</form>
