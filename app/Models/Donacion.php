<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    public const PENDIENTE = 'PENDIENTE';

    public const APROBADO = 'APROBADO';

    public const RECHAZADO = 'RECHAZADO';

    protected $table = 'donaciones';

    protected $fillable = ['referencia', 'monto', 'estado', 'metodo', 'correo', 'transaccion_wompi'];

    protected $attributes = ['estado' => self::PENDIENTE];

    protected function casts(): array
    {
        return ['monto' => 'integer'];
    }

    public function getRouteKeyName(): string
    {
        return 'referencia';
    }
}
