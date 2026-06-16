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
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->string('nombreEmpleado');
            $table->string("nombrePropietario");
            $table->string("telefonoPropietario");
            $table->string("descripcion");
            $table->string("direccion");
            $table->string('categoria');
            $table->integer("valor");
            $table->date('fecha');
            $table->boolean('esConcertado');
            $table->integer('puntos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
