# Publicar la página

La página se publica gratis en Netlify como sitio estático, más una función que firma los pagos de Wompi. Laravel se usa en el computador para generar el sitio; Netlify no lo ejecuta.

## Actualizar el sitio

Después de cambiar vistas, estilos o fotos:

```
npm run build
php artisan sitio:exportar
```

Mientras se use el modo de pruebas de Wompi, agrega `--prueba` para mostrar el aviso. Luego haz commit de la carpeta `sitio/public`.

## Variables en Netlify

Configúralas en el panel de Netlify, en las variables de entorno del sitio. Nunca las subas a Git.

```
WOMPI_PUBLIC_KEY=
WOMPI_INTEGRITY_SECRET=
```

## Orden de publicación

1. Agrega en Netlify las llaves de **prueba**.
2. Abre un pull request de la rama hacia `main` para obtener una vista previa, sin unirlo.
3. En la vista previa, haz un pago de prueba y confirma que Wompi muestra el monto elegido y que vuelves a `/gracias/`.
4. Habilita los métodos de pago en el modo producción de Wompi.
5. Cambia en Netlify a las llaves de **producción**.
6. Genera el sitio sin `--prueba`, haz commit y sube la rama.
7. Une la rama a `main`.
8. Haz un pago real pequeño y confirma que llega a la cuenta de la fundación.

## Vuelta atrás

Netlify guarda los despliegues anteriores: desde su panel se puede volver a publicar la versión previa.

## Si algún día hay hosting con PHP

La rama `rediseno-laravel` conserva la versión con base de datos y confirmación automática de pagos. Necesita PHP 8.3 o superior, `APP_ENV=production` y `APP_DEBUG=false`, y además la llave `WOMPI_EVENTS_SECRET`.

## Pendiente de la fundación

- Renovar el dominio antes del 21 de enero de 2027, en Squarespace Domains.
- Confirmar las cifras de impacto antes de publicarlas.
