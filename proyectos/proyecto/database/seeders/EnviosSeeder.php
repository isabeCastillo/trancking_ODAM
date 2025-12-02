<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Envio;

class EnviosSeeder extends Seeder
{
    public function run(): void
    {
        
        if (Envio::where('codigo_tracking', 'ENV-0001')->exists()) {
            return;
        }

        Envio::create([
            'remitente_nombre'       => 'PEDRO',
            'remitente_telefono'     => '77778888',
            'remitente_direccion'    => 'San Miguel',

            'destinatario_nombre'    => 'JUAN',
            'destinatario_telefono'  => '77770000',
            'destinatario_direccion' => 'Usulután',

            'descripcion'            => 'Caja mediana de repuestos',
            'peso'                   => 3.4,
            'tipo_envio'             => 'Caja',
            'fecha_estimada'         => '2025-12-10',

            'estado'                 => 'pendiente',
            'id_motorista'           => 2,   
            'id_vehiculo'            => 1,  

            'codigo_tracking'        => 'ENV-0001',
        ]);
    }
}

