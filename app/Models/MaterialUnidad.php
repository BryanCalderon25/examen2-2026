<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialUnidad extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'material_unidad';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'unidad_id',
        'material_id',
        'cantidad',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cantidad' => 'integer',
        ];
    }

    /**
     * Relación Pertenece a: Este registro de inventario pertenece a una Unidad.
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }

    /**
     * Relación Pertenece a: Este registro de inventario pertenece a un Material.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
