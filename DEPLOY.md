# Publicar la página

La página actual sigue en Netlify desde `main`. Netlify no ejecuta PHP, así que la versión Laravel necesita otro hosting. No cambies el dominio hasta que la versión nueva funcione en la dirección temporal del hosting.

## Requisitos del hosting

- PHP 8.3 o superior, con las extensiones que pide Laravel.
- Base de datos MySQL, PostgreSQL o SQLite persistente.
- HTTPS y dominio propio.
- La carpeta pública debe ser `public/`.

## Variables de entorno

```
APP_NAME="Fundación Casa de Dios"
APP_ENV=production
APP_DEBUG=false
APP_KEY=            # php artisan key:generate --show
APP_URL=https://fundacionfuentesdeaguaviva.org
APP_LOCALE=es

DB_CONNECTION=      # y los datos de conexión del hosting

WOMPI_PUBLIC_KEY=
WOMPI_INTEGRITY_SECRET=
WOMPI_EVENTS_SECRET=
```

Nunca publiques estos valores ni los subas a Git.

## Comandos de despliegue

```
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan optimize
```

## Orden de publicación

1. Publica la rama `rediseno-laravel` en la dirección temporal del hosting, con llaves de **prueba**.
2. En Wompi, modo de pruebas, configura la URL de eventos: `https://DIRECCION/wompi/eventos`.
3. Haz un pago de prueba y confirma que vuelves a "Gracias" y que la donación queda aprobada.
4. Haz también un pago rechazado y confirma que queda rechazado.
5. Agrega el dominio en el hosting y copia los registros DNS que indique.
6. Cambia esos registros donde se administra el DNS, hoy en Netlify. Baja el TTL antes si es posible.
7. Cambia a las llaves de **producción** y configura la URL de eventos en el modo real de Wompi: `https://fundacionfuentesdeaguaviva.org/wompi/eventos`.
8. Haz un pago real pequeño y confirma que llega a la cuenta de la fundación.
9. Une la rama a `main` y deja de usar Netlify solo cuando todo funcione.

## Vuelta atrás

Mientras no borres el sitio de Netlify, basta con devolver los registros DNS para regresar a la página anterior.

## Pendiente de la fundación

- Renovar el dominio antes del 21 de enero de 2027, en Squarespace Domains.
- Confirmar las cifras de impacto antes de publicarlas.
