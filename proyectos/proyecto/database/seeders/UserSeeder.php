<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin
        User::create([
            'name' => 'Admin Rodrigo',
            'email' => 'portillojosuerodrigocastillo@gmail.com',
            'password' => Hash::make('admin123'),
            'rol' => 'admin',
        ]);
        // Motorista
        User::create([
            'name' => 'Motorista Will',
            'email' => 'mc408362@gmail.com',
            'password' => Hash::make('diana123'),
            'rol' => 'motorista',
        ]);
    }
}
