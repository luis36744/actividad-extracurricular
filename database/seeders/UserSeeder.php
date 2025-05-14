<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Usuarios alumnos
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Alumno $i",
                'email' => "alumno{$i}@demo.com",
                'password' => Hash::make('password'),
                'role' => 'alumno',
            ]);
        }
    }
}
