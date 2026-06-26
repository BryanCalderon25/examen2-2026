<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Categoria;
use PHPUnit\Framework\Attributes\Test;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase; // Limpiar la BD en cada prueba

    #[Test]
    public function dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente()
    {
        // Arrange: Preparar el entorno creando una categoría válida
        $categoria = Categoria::create([
            'nombre' => 'Suministros de Oficina'
        ]);

        $payload = [
            'unidadMedida' => 'Cajas',
            'descripcion'  => 'Resmas de papel bond',
            'ubicacion'    => 'Bodega Central, Estante 3',
            'categoria_id' => $categoria->idCategoria
        ];

        // Act: Ejecutar la solicitud POST al endpoint
        $response = $this->postJson('/api/materiales', $payload);

        // Assert: Verificar que se creó correctamente y existe en la base de datos
        $response->assertStatus(201);
        $this->assertDatabaseHas('materiales', [
            'descripcion' => 'Resmas de papel bond'
        ]);
    }
}