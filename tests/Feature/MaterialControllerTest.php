<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Valida que el endpoint encargado de insertar nuevos registros de materiales,
     * para el escenario en el cual el material no existe, lo hace correctamente.
     *
     * Endpoint: POST /api/materiales
     */
    public function dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente(): void
    {
        // DADO: Una categoría existente en la base de datos
        $categoria = Categoria::create(['nombre' => 'Materiales de Construcción']);

        // Y que el material NO existe aún en la base de datos
        $this->assertDatabaseMissing('materiales', [
            'descripcion' => 'Cemento Portland Tipo I',
        ]);

        // CUANDO: Se llama al endpoint POST /api/materiales con datos válidos
        $payload = [
            'unidadMedida' => 'saco',
            'descripcion'  => 'Cemento Portland Tipo I',
            'ubicacion'    => 'Bodega A - Estante 3',
            'categoria_id' => $categoria->idCategoria,
        ];

        $response = $this->postJson('/api/materiales', $payload);

        // ENTONCES: La respuesta debe ser 201 Created
        $response->assertStatus(201);

        // Y la respuesta JSON debe contener el material creado con su categoría
        $response->assertJsonFragment([
            'message' => 'Material creado exitosamente.',
        ]);

        $response->assertJsonPath('material.descripcion', 'Cemento Portland Tipo I');
        $response->assertJsonPath('material.unidadMedida', 'saco');
        $response->assertJsonPath('material.ubicacion', 'Bodega A - Estante 3');
        $response->assertJsonPath('material.categoria_id', $categoria->idCategoria);

        // Y el material debe haberse persistido correctamente en la base de datos
        $this->assertDatabaseHas('materiales', [
            'descripcion'  => 'Cemento Portland Tipo I',
            'unidadMedida' => 'saco',
            'ubicacion'    => 'Bodega A - Estante 3',
            'categoria_id' => $categoria->idCategoria,
        ]);
    }

    /**
     * Método de prueba usando la convención de PHPUnit (prefijo test_)
     * para que sea detectado automáticamente por el runner.
     */
    public function test_dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente(): void
    {
        $this->dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente();
    }
}
