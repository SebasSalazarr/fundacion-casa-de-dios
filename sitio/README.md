# Sitio para Netlify

- `public/`: archivos generados con `php artisan sitio:exportar`. No los edites a mano.
- `functions/`: función que firma los pagos de Wompi.

Para recibir pagos reales: pon `MODO_PRUEBA = false` en `functions/donar.mjs`, genera el sitio sin `--prueba` y publica también en el proyecto `fundacion-casa-de-dios-agua-viva`, que firma los pagos.

La función necesita las variables `WOMPI_PUBLIC_KEY` y `WOMPI_INTEGRITY_SECRET` en Netlify. La guía de publicación está en `DEPLOY.md`.
