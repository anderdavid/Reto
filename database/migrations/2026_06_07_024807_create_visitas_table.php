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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->string('nombreEmpleado');
            $table->string("nombrePropietario");
            $table->string("telefonoPropietario");
            $table->string("descripcion");
            $table->string("direccion");
            $table->string('categoria');
            $table->integer("valor");
            $table->integer('evaluacion');
            $table->date('fecha');
            $table->integer('calificacion');
            $table->integer('comision');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
