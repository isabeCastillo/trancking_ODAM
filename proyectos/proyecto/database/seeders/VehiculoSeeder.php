<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        Vehiculo::create([
            'placa' => 'P123-456',
            'marca' => 'Toyota',
            'modelo' => 'Hiace',
            'color' => 'Blanco',
            'capacidad' => 12,
            'tipo' => 'Van',
            'estado' => 'Disponible',
        ]);

        Vehiculo::create([
            'placa' => 'P987-654',
            'marca' => 'Nissan',
            'modelo' => 'NV350',
            'color' => 'Gris',
            'capacidad' => 10,
            'tipo' => 'Furgón',
            'estado' => 'Mantenimiento',
        ]);
    }
}
