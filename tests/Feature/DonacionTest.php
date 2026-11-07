<?php

namespace Tests\Feature;

use App\Models\Donacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonacionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        config([
            'services.wompi.checkout_url' => 'https://checkout.wompi.co/l/test_abc',
            'services.wompi.public_key' => 'pub_test_llave',
            'services.wompi.integrity_secret' => 'secreto_integridad',
            'services.wompi.events_secret' => 'secreto_eventos',
        ]);
    }

    private function evento(Donacion $donacion, array $transaccion = []): array
    {
        $transaccion = [
            'id' => '1234-abc',
            'amount_in_cents' => $donacion->monto * 100,
            'reference' => $donacion->referencia,
            'customer_email' => 'donante@example.com',
            'payment_method_type' => 'NEQUI',
            'status' => 'APPROVED',
            ...$transaccion,
        ];
        $timestamp = 1530291411;

        return [
            'event' => 'transaction.updated',
            'data' => ['transaction' => $transaccion],
            'signature' => [
                'properties' => ['transaction.id', 'transaction.status', 'transaction.amount_in_cents'],
                'checksum' => strtoupper(hash('sha256',
                    $transaccion['id'].$transaccion['status'].$transaccion['amount_in_cents'].$timestamp.'secreto_eventos'
                )),
            ],
            'timestamp' => $timestamp,
        ];
    }

    public function test_iniciar_registra_la_donacion_y_firma_el_pago(): void
    {
        $respuesta = $this->post('/donar', ['monto' => 20000]);

        $donacion = Donacion::sole();
        $this->assertSame(Donacion::PENDIENTE, $donacion->estado);
        $this->assertSame(20000, $donacion->monto);

        $url = $respuesta->assertRedirect()->headers->get('Location');
        parse_str(parse_url($url, PHP_URL_QUERY), $datos);

        $this->assertStringStartsWith('https://checkout.wompi.co/p/', $url);
        $this->assertSame('pub_test_llave', $datos['public-key']);
        $this->assertSame('2000000', $datos['amount-in-cents']);
        $this->assertSame($donacion->referencia, $datos['reference']);
        $this->assertSame(
            hash('sha256', $donacion->referencia.'2000000COPsecreto_integridad'),
            $datos['signature:integrity'],
        );
        $this->assertStringNotContainsString('secreto_integridad', $url);
    }

    public function test_solo_envia_la_direccion_de_regreso_si_es_publica(): void
    {
        $local = $this->post('http://localhost/donar', ['monto' => 5000])->headers->get('Location');
        $this->assertStringNotContainsString('redirect-url', $local);

        $publica = $this->post('https://fundacion.example/donar', ['monto' => 5000])->headers->get('Location');
        parse_str(parse_url($publica, PHP_URL_QUERY), $datos);
        $this->assertStringStartsWith('https://fundacion.example/donar/gracias/FCD-', $datos['redirect-url']);
    }

    public function test_sin_llaves_usa_el_enlace_de_pago_y_no_registra_nada(): void
    {
        config(['services.wompi.public_key' => null]);

        $this->post('/donar', ['monto' => 5000])
            ->assertRedirect('https://checkout.wompi.co/l/test_abc?amount-in-cents=500000');

        $this->assertSame(0, Donacion::count());
    }

    public function test_un_enlace_viejo_por_get_lleva_al_formulario_sin_registrar_nada(): void
    {
        $this->get('/donar?monto=20000')->assertRedirect(route('inicio').'#donar');

        $this->assertSame(0, Donacion::count());
    }

    public function test_rechaza_montos_que_no_estan_en_la_lista(): void
    {
        $this->post('/donar', ['monto' => 1])->assertSessionHasErrors('monto');
        $this->post('/donar')->assertSessionHasErrors('monto');
        $this->assertSame(0, Donacion::count());
    }

    public function test_un_evento_firmado_aprueba_la_donacion(): void
    {
        $donacion = Donacion::create(['referencia' => 'FCD-1', 'monto' => 10000]);

        $this->postJson('/wompi/eventos', $this->evento($donacion))->assertOk();

        $donacion->refresh();
        $this->assertSame(Donacion::APROBADO, $donacion->estado);
        $this->assertSame('NEQUI', $donacion->metodo);
        $this->assertSame('donante@example.com', $donacion->correo);
        $this->assertSame('1234-abc', $donacion->transaccion_wompi);
    }

    public function test_un_pago_declinado_queda_rechazado(): void
    {
        $donacion = Donacion::create(['referencia' => 'FCD-2', 'monto' => 10000]);

        $this->postJson('/wompi/eventos', $this->evento($donacion, ['status' => 'DECLINED']))->assertOk();

        $this->assertSame(Donacion::RECHAZADO, $donacion->refresh()->estado);
    }

    public function test_ignora_eventos_con_firma_falsa(): void
    {
        $donacion = Donacion::create(['referencia' => 'FCD-3', 'monto' => 10000]);
        $evento = $this->evento($donacion);
        $evento['signature']['checksum'] = str_repeat('A', 64);

        $this->postJson('/wompi/eventos', $evento)->assertUnauthorized();

        $this->assertSame(Donacion::PENDIENTE, $donacion->refresh()->estado);
    }

    public function test_no_aprueba_si_el_monto_no_coincide(): void
    {
        $donacion = Donacion::create(['referencia' => 'FCD-4', 'monto' => 10000]);

        $this->postJson('/wompi/eventos', $this->evento($donacion, ['amount_in_cents' => 100]))->assertOk();

        $this->assertSame(Donacion::PENDIENTE, $donacion->refresh()->estado);
    }

    public function test_la_pagina_de_regreso_no_aprueba_por_si_sola(): void
    {
        $donacion = Donacion::create(['referencia' => 'FCD-5', 'monto' => 10000]);

        $this->get('/donar/gracias/FCD-5?id=1234-abc')
            ->assertOk()
            ->assertSee('Estamos confirmando tu pago');

        $this->assertSame(Donacion::PENDIENTE, $donacion->refresh()->estado);

        $donacion->update(['estado' => Donacion::APROBADO]);
        $this->get('/donar/gracias/FCD-5')->assertSee('Gracias por tu donación');
    }
}
