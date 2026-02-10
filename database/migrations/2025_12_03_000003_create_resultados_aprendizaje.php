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
        Schema::create('resultados_aprendizaje', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modulo_formativo_id')->nullable();
            $table->string('codigo', 50);
            $table->string('descripcion');
            $table->float('peso_porcentaje')->check('peso_porcentaje >= 0 AND peso_porcentaje <= 100')->nullable();
            $table->integer('orden')->check('orden >= 1');
            $table->timestamps();
            $table->foreign('modulo_formativo_id')->references('id')->on('modulos_formativos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_aprendizaje');
    }
};
