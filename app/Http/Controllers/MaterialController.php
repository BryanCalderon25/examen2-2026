<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateMaterialRequest;

class MaterialController extends Controller
{
    public function store(Request $request)
    {
        // Validación de los datos entrantes
        $validated = $request->validate([
            'unidadMedida' => 'required|string',
            'descripcion'  => 'required|string',
            'ubicacion'    => 'required|string',
            'categoria_id' => 'required|exists:categorias,idCategoria'
        ]);

        // Inserción en la base de datos
        $material = Material::create($validated);

        return response()->json([
            'message' => 'Material creado exitosamente',
            'data'    => $material
        ], 201);
    }

    public function update(UpdateMaterialRequest $request, Material $material)
    {
        // Actualización en la base de datos
        $material->update($request->validated());

        // Integración de la relación Eloquent para actualizar el inventario de las unidades si se incluye en la petición
        if ($request->has('unidades')) {
            $unidadesSync = [];
            foreach ($request->input('unidades') as $unidadData) {
                $unidadesSync[$unidadData['unidad_id']] = ['cantidad' => $unidadData['cantidad']];
            }
            $material->unidades()->sync($unidadesSync);
        }

        return response()->json([
            'message' => 'Material actualizado exitosamente',
            'data'    => $material->load('unidades')
        ], 200);
    }
}