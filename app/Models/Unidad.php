<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Unidad extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'unidades';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Relación Uno a Muchos: Una Unidad tiene muchos Presupuestos.
     */
    public function presupuestos(): HasMany
    {
        return $this->hasMany(Presupuesto::class);
    }

    /**
     * Relación Uno a Muchos: Una Unidad tiene muchas Requisiciones.
     */
    public function requisiciones(): HasMany
    {
        return $this->hasMany(Requisicion::class);
    }

    /**
     * Relación Muchos a Muchos: Una Unidad tiene muchos Materiales (Inventario).
     */
    public function materiales(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'material_unidad')
                    ->using(MaterialUnidad::class)
                    ->withPivot(['id', 'cantidad'])
                    ->withTimestamps();
    }

    /**
     * Relación Uno a Muchos hacia la clase asociativa directamente.
     */
    public function inventarios(): HasMany
    {
        return $this->hasMany(MaterialUnidad::class);
    }
}
