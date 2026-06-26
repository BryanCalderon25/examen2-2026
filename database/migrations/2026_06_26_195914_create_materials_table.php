<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id('codigo'); // Llave primaria según el UML
            $table->string('unidadMedida');
            $table->string('descripcion');
            $table->string('ubicacion');
            // Llave foránea hacia la tabla categorias
            $table->foreignId('categoria_id')->constrained('categorias', 'idCategoria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
