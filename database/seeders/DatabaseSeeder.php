<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mesa;
use App\Models\Reserva;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(50)->create();
        Mesa::factory()->count(15)->create();
        Reserva::factory()->count(20)->create();
    }
}
