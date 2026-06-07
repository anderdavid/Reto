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
            $table->integer('comision');
            $table->integer('calificacion');
            $table->integer('evaluacion');
            $table->date('fecha');

            $table->foreignId('propiedad_id')
                ->nullable()
                ->constrained('propiedades')
                ->onDelete('cascade');

            $table->foreignId('negocio_id')
                ->nullable()
                ->constrained('negocios')
                ->onDelete('cascade');
            
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
