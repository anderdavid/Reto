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
            $table->date('fecha');

            $table->integer('ubicacion');
            $table->integer('precio');
            $table->integer('acuerdo');
            $table->integer('calificacionPuntos');
            $table->string('calificacion');

            $table->integer('comisionPropuesta');
            $table->integer('comisionEmpleado');
         

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
