<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->id();

            // Remitente
            $table->string('remitente_nombre');
            $table->string('remitente_telefono')->nullable();
            $table->string('remitente_direccion')->nullable();

            // Destinatario
            $table->string('destinatario_nombre');
            $table->string('destinatario_telefono')->nullable();
            $table->string('destinatario_direccion')->nullable();

            // Detalles
            $table->text('descripcion')->nullable();
            $table->decimal('peso', 8, 2)->nullable();
            $table->string('tipo_envio')->nullable();
            $table->date('fecha_estimada')->nullable();
            $table->string('estado')->default('pendiente');

            // Asignaciones
            $table->foreignId('id_motorista')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('id_vehiculo')
                ->nullable()
                ->constrained('vehiculos')
                ->nullOnDelete();

            // Tracking
            $table->string('codigo_tracking')->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
