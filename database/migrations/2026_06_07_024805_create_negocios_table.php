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
            $table->date('fecha');
            $table->string('nombreEmpleado');
            $table->string('categoria');
            $table->integer('puntosConcertados');
            $table->integer('puntosCaptados');
            
            $table->foreignId('propiedad_id')
                ->nullable()
                ->constrained('propiedades')
                ->onDelete('cascade');


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
