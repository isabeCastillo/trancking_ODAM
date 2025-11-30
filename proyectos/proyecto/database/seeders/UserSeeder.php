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
            'name' => 'Rodrigo Portillo',
            'username' => 'rodri',
            'email' => 'portillojosuerodrigocastillo@gmail.com',
            'password' => Hash::make('roPort123'),
            'rol' => 'admin',
        ]);
        //motorista
        User::create([
            'name' => 'Will Sanchez',
            'username' => 'will',
            'email' => 'mc408362@gmail.com',
            'password' => Hash::make('willSa123'),
            'rol' => 'motorista',
        ]);
    }
}
 