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
        Schema::dropIfExists('comentarios');
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidencia_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('contenido');
            $table->enum('tipo', ['publico', 'privado']);
            $table->text('observaciones')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->foreign('evidencia_id')->references('id')->on('evidencias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
