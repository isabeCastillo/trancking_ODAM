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
        Schema::create('historial_envios', function (Blueprint $table) {
            $table->id();

            // Relación con envíos
            $table->foreignId('envio_id')
                ->constrained('envios')
                ->cascadeOnDelete();

            // Usuario que hizo el cambio (motorista o admin)
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Estado nuevo del envío
            $table->string('estado');

            // Comentario opcional
            $table->text('comentario')->nullable();

            // Foto de evidencia (ruta)
            $table->string('foto')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_envios');
    }
};
