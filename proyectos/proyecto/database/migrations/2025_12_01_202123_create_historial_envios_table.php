<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_envios', function (Blueprint $table) {
            $table->id();

            $table->foreignId('envio_id')
                ->constrained('envios')
                ->onDelete('cascade');

            // motorista / usuario que realizó el cambio
            $table->foreignId('id_usuario')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('estado_anterior')->nullable();
            $table->string('estado_nuevo');
            $table->text('comentario')->nullable();
            $table->string('evidencia_foto')->nullable();
            $table->timestamp('fecha_hora')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_envios');
    }
};