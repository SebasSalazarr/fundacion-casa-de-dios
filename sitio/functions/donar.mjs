import { createHash, randomUUID } from 'node:crypto';

const MONTOS = [5000, 10000, 20000, 50000];
const MONEDA = 'COP';

// Firma el pago en el servidor para que el secreto de integridad nunca llegue al navegador.
export default async (peticion) => {
    const url = new URL(peticion.url);
    const inicio = `${url.origin}/#donar`;
    const monto = Number(url.searchParams.get('monto'));
    const llavePublica = process.env.WOMPI_PUBLIC_KEY;
    const secreto = process.env.WOMPI_INTEGRITY_SECRET;

    if (!MONTOS.includes(monto) || !llavePublica || !secreto) {
        return Response.redirect(inicio, 302);
    }

    const centavos = monto * 100;
    const referencia = `FCD-${randomUUID()}`;
    const firma = createHash('sha256').update(`${referencia}${centavos}${MONEDA}${secreto}`).digest('hex');

    const pago = new URL('https://checkout.wompi.co/p/');
    pago.searchParams.set('public-key', llavePublica);
    pago.searchParams.set('currency', MONEDA);
    pago.searchParams.set('amount-in-cents', String(centavos));
    pago.searchParams.set('reference', referencia);
    pago.searchParams.set('signature:integrity', firma);

    // Wompi bloquea con un 403 las direcciones de regreso locales.
    if (!['localhost', '127.0.0.1'].includes(url.hostname)) {
        pago.searchParams.set('redirect-url', `${url.origin}/gracias/`);
    }

    return Response.redirect(pago.toString(), 302);
};

export const config = { path: '/donar' };
