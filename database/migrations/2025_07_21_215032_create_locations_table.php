<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración: crea la tabla 'locations'
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id(); // location_id automáticamente generado
            $table->string('name');
            $table->text('address');         // Dirección completa
            $table->string('city');          // Ciudad
            $table->string('country');       // País
            $table->integer('capacity');     // Aforo máximo del lugar

            $table->timestamps();           // created_at y updated_at
        });
    }

    /**
     * Revierte la migración: elimina la tabla 'locations'
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};