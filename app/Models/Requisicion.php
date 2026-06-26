<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Requisicion extends Model
{
    use HasFactory;

    protected $table = 'requisiciones';

    protected $fillable = [
        'unidad_id',
        'fecha',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    /**
     * Relación: Una Requisición es tramitada por una Unidad.
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }

    /**
     * Relación: Una Requisición solicita muchos Materiales.
     */
    public function materiales(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'material_requisicion', 'requisicion_id', 'material_id')
                    ->withPivot('cantidad_solicitada')
                    ->withTimestamps();
    }
}
