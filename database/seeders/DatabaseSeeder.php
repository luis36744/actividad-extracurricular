<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event; // Agregado para evitar el error
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Aquí siembras 20 eventos de prueba:
        Event::factory()->count(20)->create();
        UserSeeder::class;
    }
}
