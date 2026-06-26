<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table = 'presupuestos';

    protected $fillable = [
        'unidad_id',
        'monto',
        'anio',
    ];

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
            'anio' => 'integer',
        ];
    }

    /**
     * Relación: Un Presupuesto pertenece a una Unidad.
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }
}
