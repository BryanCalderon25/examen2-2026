<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

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
}