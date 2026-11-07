# Sitio para Netlify

- `public/`: archivos generados con `php artisan sitio:exportar`. No los edites a mano.
- `functions/`: función que firma los pagos de Wompi.

La función necesita las variables `WOMPI_PUBLIC_KEY` y `WOMPI_INTEGRITY_SECRET` en Netlify. La guía de publicación está en `DEPLOY.md`.
