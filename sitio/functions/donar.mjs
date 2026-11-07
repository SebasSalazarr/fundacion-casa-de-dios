import { createHash, randomUUID } from 'node:crypto';

const MONTOS = [5000, 10000, 20000, 50000];
const MONEDA = 'COP';
// Cámbialo a false cuando Wompi tenga activos los medios de pago en producción.
const MODO_PRUEBA = true;
const ENLACE_PRUEBA = 'https://checkout.wompi.co/l/test_VPOS_1GVlws';
const DOMINIO = 'https://fundacionfuentesdeaguaviva.org';
// El proyecto de Netlify del dominio no tiene llaves; este sí, y firma los pagos.
const FIRMANTE = 'https://fundacion-casa-de-dios-agua-viva.netlify.app';

// Firma el pago en el servidor para que el secreto de integridad nunca llegue al navegador.
export default async (peticion) => {
    const url = new URL(peticion.url);
    const inicio = `${url.origin}/#donar`;
    const monto = Number(url.searchParams.get('monto'));
    const llavePublica = process.env.WOMPI_PUBLIC_KEY;
    const secreto = process.env.WOMPI_INTEGRITY_SECRET;

    if (MODO_PRUEBA && MONTOS.includes(monto)) {
        return Response.redirect(`${ENLACE_PRUEBA}?amount-in-cents=${monto * 100}`, 302);
    }

    if (MONTOS.includes(monto) && (!llavePublica || !secreto) && url.origin !== FIRMANTE) {
        return Response.redirect(`${FIRMANTE}/donar?monto=${monto}`, 302);
    }

    const motivo = !MONTOS.includes(monto) ? 'monto' : !llavePublica ? 'falta-llave-publica' : !secreto ? 'falta-secreto' : null;

    if (motivo) {
        return new Response(null, { status: 302, headers: { Location: inicio, 'X-Donar-Motivo': motivo } });
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
        pago.searchParams.set('redirect-url', `${DOMINIO}/gracias/`);
    }

    return Response.redirect(pago.toString(), 302);
};

export const config = { path: '/donar' };
