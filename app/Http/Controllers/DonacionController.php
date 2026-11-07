<?php

namespace App\Http\Controllers;

use App\Models\Donacion;
use App\Services\Wompi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DonacionController extends Controller
{
    /**
     * Registra la donación como pendiente y envía al donante al pago de Wompi.
     */
    public function iniciar(Request $request, Wompi $wompi): RedirectResponse
    {
        $datos = $request->validate([
            'monto' => ['required', 'integer', Rule::in(config('services.wompi.montos'))],
        ]);

        if (! $wompi->configurado()) {
            return redirect()->away($wompi->urlEnlaceDePago((int) $datos['monto']));
        }

        $donacion = Donacion::create([
            'referencia' => 'FCD-'.Str::ulid(),
            'monto' => $datos['monto'],
        ]);

        return redirect()->away($wompi->urlCheckout($donacion));
    }

    /**
     * Página de regreso. Es solo informativa: el estado lo confirma el evento de Wompi.
     */
    public function gracias(Donacion $donacion): View
    {
        return view('gracias', ['donacion' => $donacion]);
    }

    /**
     * Recibe las notificaciones firmadas de Wompi y actualiza el estado.
     */
    public function evento(Request $request, Wompi $wompi): Response
    {
        $evento = $request->json()->all();

        if (! $wompi->eventoValido($evento)) {
            Log::warning('Wompi: evento con firma inválida.');

            return response()->noContent(401);
        }

        $transaccion = data_get($evento, 'data.transaction', []);
        $estado = match ($transaccion['status'] ?? null) {
            'APPROVED' => Donacion::APROBADO,
            'DECLINED', 'VOIDED', 'ERROR' => Donacion::RECHAZADO,
            default => null,
        };

        $donacion = Donacion::firstWhere('referencia', $transaccion['reference'] ?? null);

        if (($evento['event'] ?? null) !== 'transaction.updated' || ! $estado || ! $donacion) {
            return response('', 200);
        }

        if ((int) ($transaccion['amount_in_cents'] ?? 0) !== $donacion->monto * 100) {
            Log::warning('Wompi: el monto no coincide.', ['referencia' => $donacion->referencia]);

            return response('', 200);
        }

        $donacion->update([
            'estado' => $estado,
            'metodo' => $transaccion['payment_method_type'] ?? null,
            'correo' => $transaccion['customer_email'] ?? null,
            'transaccion_wompi' => $transaccion['id'] ?? null,
        ]);

        return response('', 200);
    }
}
