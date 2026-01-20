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
        Schema::dropIfExists('evaluaciones');
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidencia_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('puntuacion');
            $table->enum('estado', ['pendiente', 'aprobado', 'suspenso']);
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->foreign('evidencia_id')->references('id')->on('evidencias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
