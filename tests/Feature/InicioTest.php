<?php

namespace Tests\Feature;

use Tests\TestCase;

class InicioTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_la_pagina_de_inicio_carga_con_el_formulario_de_donacion(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Turbo, Antioquia')
            ->assertSee('Donación voluntaria')
            ->assertSee('Misión')
            ->assertSee('name="monto"', false);
    }

    public function test_la_galeria_muestra_las_62_fotos_sin_repetidas(): void
    {
        $respuesta = $this->get('/fotos')->assertOk();

        $this->assertSame(62, substr_count($respuesta->getContent(), 'data-foto'));
        $respuesta->assertDontSee('e21-480.webp');
    }

    public function test_avisa_cuando_wompi_esta_en_modo_de_prueba(): void
    {
        config([
            'services.wompi.public_key' => null,
            'services.wompi.integrity_secret' => null,
            'services.wompi.checkout_url' => 'https://checkout.wompi.co/l/test_abc',
        ]);
        $this->get('/')->assertSee('Modo de prueba');

        config(['services.wompi.checkout_url' => 'https://checkout.wompi.co/l/abc']);
        $this->get('/')->assertDontSee('Modo de prueba');

        config(['services.wompi.public_key' => 'pub_test_x', 'services.wompi.integrity_secret' => 'y']);
        $this->get('/')->assertSee('Modo de prueba');

        config(['services.wompi.public_key' => 'pub_prod_x']);
        $this->get('/')->assertDontSee('Modo de prueba');
    }
}
