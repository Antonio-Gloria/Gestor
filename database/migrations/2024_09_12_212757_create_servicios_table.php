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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_servicio_id')->constrained('tipo_servicios');
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado', 50);
            $table->unsignedBigInteger('tecnico_id')->nullable(); // Cambiado a nullable
            $table->string('nombre_solicitante', 150);
            $table->string('apellido_solicitante', 150);
            $table->string('departamento', 50);
            $table->string('codigo', 50);
            $table->string('contacto', 50);
            $table->string('tipo', 50);
            $table->integer('status');
            $table->date('fechaRealizado')->nullable();
            $table->string('email');
            $table->string( 'descripcion', 350)->nullable();
            $table->timestamps();
    
            //$table->foreign('tipo_servicio_id')->references('id')->on('tipo_servicios')->onDelete('cascade');
            $table->foreign('tecnico_id')->references('id')->on('tecnicos')->onDelete('cascade');
    
            //$table->index('tipo_servicio_id');
            $table->index('tecnico_id');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
