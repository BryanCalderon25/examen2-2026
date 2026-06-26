<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requisiciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unidad_id')->constrained('unidades')->onDelete('cascade');
            $table->date('fecha');
            $table->string('estado', 50)->default('pendiente');
            $table->timestamps();
        });

        // Tabla pivote para Material y Requisicion (requisicion "solicita" materiales)
        Schema::create('material_requisicion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requisicion_id')->constrained('requisiciones')->onDelete('cascade');
            // Recordar que la tabla materiales usa 'codigo' como llave primaria
            $table->foreignId('material_id')->constrained('materiales', 'codigo')->onDelete('cascade');
            $table->integer('cantidad_solicitada')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_requisicion');
        Schema::dropIfExists('requisiciones');
    }
};
