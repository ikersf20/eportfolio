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
        Schema::dropIfExists('asignaciones');
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidencia_id')->nullable();
            $table->unsignedBigInteger('revisor_id')->nullable();
            $table->unsignedBigInteger('asignado_por_id')->nullable();
            $table->date('fecha_limite');
            $table->enum('estado', ['pendiente', 'en_proceso', 'completado']);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->foreign('evidencia_id')->references('id')->on('evidencias')->onDelete('cascade');
            $table->foreign('revisor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('asignado_por_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};
