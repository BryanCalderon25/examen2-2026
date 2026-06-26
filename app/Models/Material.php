<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';
    protected $primaryKey = 'codigo';
    protected $fillable = ['unidadMedida', 'descripcion', 'ubicacion', 'categoria_id'];

    // Relación: Un material pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'idCategoria');
    }

    // Integración requerida por el equipo (Bryan)
    // Relación Muchos a Muchos: Un material puede estar en varias unidades
    public function unidades()
    {
        return $this->belongsToMany(Unidad::class, 'material_unidad', 'material_id', 'unidad_id')
                    ->using(MaterialUnidad::class)
                    ->withPivot(['id', 'cantidad'])
                    ->withTimestamps();
    }

    // Relación Muchos a Muchos: Un material puede estar en varias requisiciones
    public function requisiciones()
    {
        return $this->belongsToMany(Requisicion::class, 'material_requisicion', 'material_id', 'requisicion_id')
                    ->withPivot('cantidad_solicitada')
                    ->withTimestamps();
    }
}
