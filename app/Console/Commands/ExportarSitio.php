<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class ExportarSitio extends Command
{
    protected $signature = 'sitio:exportar
        {--prueba : Muestra el aviso de modo de prueba en el formulario}
        {--destino= : Carpeta de salida}';

    protected $description = 'Genera la versión estática de la página para Netlify';

    private const RAIZ = 'https://sitio.invalid';

    public function handle(): int
    {
        $destino = $this->option('destino') ?: base_path('sitio/public');

        config([
            'services.wompi.estatico' => true,
            'services.wompi.aviso_prueba' => (bool) $this->option('prueba'),
        ]);
        URL::forceRootUrl(self::RAIZ);
        URL::useAssetOrigin(self::RAIZ);

        File::deleteDirectory($destino);
        File::ensureDirectoryExists($destino);

        $this->escribir("{$destino}/index.html", 'home');
        $this->escribir("{$destino}/fotos/index.html", 'fotos');
        $this->escribir("{$destino}/gracias/index.html", 'gracias-estatica');

        if (File::isDirectory(public_path('build/assets'))) {
            File::copyDirectory(public_path('build/assets'), "{$destino}/build/assets");
        }

        File::copyDirectory(public_path('img/web'), "{$destino}/img/web");
        File::copy(public_path('img/ee.mp4'), "{$destino}/img/ee.mp4");
        File::copy(public_path('img/logo.jpeg'), "{$destino}/img/logo.jpeg");

        $this->info("Sitio exportado en {$destino}");

        return self::SUCCESS;
    }

    private function escribir(string $archivo, string $vista): void
    {
        $html = view($vista)->render();
        $html = preg_replace('#https?://sitio\.invalid/?#', '/', $html);

        File::ensureDirectoryExists(dirname($archivo));
        File::put($archivo, $html);
    }
}
