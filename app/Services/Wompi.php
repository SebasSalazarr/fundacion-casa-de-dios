<?php

namespace App\Services;

use App\Models\Donacion;

class Wompi
{
    private const CHECKOUT = 'https://checkout.wompi.co/p/';

    private const MONEDA = 'COP';

    /**
     * Indica si hay llaves para generar pagos firmados y registrar donaciones.
     */
    public function configurado(): bool
    {
        return filled(config('services.wompi.public_key'))
            && filled(config('services.wompi.integrity_secret'));
    }

    public function enPrueba(): bool
    {
        return $this->configurado()
            ? str_starts_with(config('services.wompi.public_key'), 'pub_test_')
            : str_contains(config('services.wompi.checkout_url'), '/test_');
    }

    /**
     * Enlace de pago simple, usado mientras no haya llaves configuradas.
     */
    public function urlEnlaceDePago(int $monto): string
    {
        return config('services.wompi.checkout_url').'?'.http_build_query([
            'amount-in-cents' => $monto * 100,
        ]);
    }

    public function urlCheckout(Donacion $donacion): string
    {
        $centavos = $donacion->monto * 100;

        $regreso = route('donar.gracias', $donacion->referencia);

        return self::CHECKOUT.'?'.http_build_query(array_filter([
            'public-key' => config('services.wompi.public_key'),
            'currency' => self::MONEDA,
            'amount-in-cents' => $centavos,
            'reference' => $donacion->referencia,
            'signature:integrity' => $this->firmaDeIntegridad($donacion->referencia, $centavos),
            // Wompi bloquea con un 403 las direcciones de regreso locales.
            'redirect-url' => $this->esDireccionLocal($regreso) ? null : $regreso,
        ]));
    }

    private function esDireccionLocal(string $url): bool
    {
        return in_array(parse_url($url, PHP_URL_HOST), ['localhost', '127.0.0.1'], true);
    }

    /**
     * Comprueba que un evento lo haya enviado Wompi, según su documentación:
     * SHA-256 de las propiedades indicadas, el timestamp y el secreto de eventos.
     */
    public function eventoValido(array $evento): bool
    {
        $secreto = config('services.wompi.events_secret');
        $propiedades = data_get($evento, 'signature.properties');
        $checksum = data_get($evento, 'signature.checksum');
        $timestamp = data_get($evento, 'timestamp');

        if (blank($secreto) || ! is_array($propiedades) || ! is_string($checksum) || blank($timestamp)) {
            return false;
        }

        $cadena = collect($propiedades)
            ->map(fn (string $propiedad) => data_get($evento, "data.{$propiedad}"))
            ->implode('');

        return hash_equals(
            hash('sha256', $cadena.$timestamp.$secreto),
            strtolower($checksum),
        );
    }

    private function firmaDeIntegridad(string $referencia, int $centavos): string
    {
        return hash('sha256', $referencia.$centavos.self::MONEDA.config('services.wompi.integrity_secret'));
    }
}
