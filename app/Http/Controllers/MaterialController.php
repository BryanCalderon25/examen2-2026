<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class MaterialController extends Controller
{
    /**
     * Insertar un material con su categoría asociada en la base de datos.
     * Endpoint: POST /api/materiales
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'unidadMedida' => 'required|string|max:255',
            'descripcion'  => 'required|string|max:255',
            'ubicacion'    => 'required|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,idCategoria',
        ]);

        $material = Material::create($validated);

        // Cargar la relación categoría para devolverla en la respuesta
        $material->load('categoria');

        return response()->json([
            'message'  => 'Material creado exitosamente.',
            'material' => $material,
        ], 201);
    }

    /**
     * Actualizar un material existente.
     * Endpoint: PUT /api/materiales/{codigo}
     */
    public function update(Request $request, int $codigo): JsonResponse
    {
        $material = Material::findOrFail($codigo);

        $validated = $request->validate([
            'unidadMedida' => 'sometimes|required|string|max:255',
            'descripcion'  => 'sometimes|required|string|max:255',
            'ubicacion'    => 'sometimes|required|string|max:255',
            'categoria_id' => 'sometimes|required|integer|exists:categorias,idCategoria',
        ]);

        $material->update($validated);
        $material->load('categoria');

        return response()->json([
            'message'  => 'Material actualizado exitosamente.',
            'material' => $material,
        ]);
    }

    /**
     * Obtener la lista de materiales con sus categorías asociadas.
     * Endpoint: GET /api/materiales
     */
    public function index(): JsonResponse
    {
        $materiales = Material::with('categoria')->get();

        return response()->json([
            'materiales' => $materiales,
        ]);
    }
}
