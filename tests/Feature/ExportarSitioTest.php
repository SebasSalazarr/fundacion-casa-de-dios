<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ExportarSitioTest extends TestCase
{
    private string $destino;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        $this->destino = storage_path('framework/testing/sitio');
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->destino);

        parent::tearDown();
    }

    public function test_genera_las_paginas_sin_rastros_del_servidor(): void
    {
        $this->artisan('sitio:exportar', ['--destino' => $this->destino])->assertSuccessful();

        $inicio = File::get("{$this->destino}/index.html");

        $this->assertStringContainsString('action="/donar" method="get"', $inicio);
        $this->assertStringContainsString('src="/img/web/e7-800.webp"', $inicio);
        $this->assertStringNotContainsString('_token', $inicio);
        $this->assertStringNotContainsString('sitio.invalid', $inicio);
        $this->assertStringNotContainsString('Modo de prueba', $inicio);

        $this->assertStringContainsString('href="/#quienes"', File::get("{$this->destino}/fotos/index.html"));
        $this->assertFileExists("{$this->destino}/gracias/index.html");
        $this->assertFileExists("{$this->destino}/img/ee.mp4");
    }

    public function test_el_aviso_de_prueba_es_opcional(): void
    {
        $this->artisan('sitio:exportar', ['--destino' => $this->destino, '--prueba' => true])->assertSuccessful();

        $this->assertStringContainsString('Modo de prueba', File::get("{$this->destino}/index.html"));
    }
}
