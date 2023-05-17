<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mesa;
use App\Models\Reserva;
use HasRoles;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Populando o Banco de Dados
        User::factory()->count(50)->create();
        Mesa::factory()->count(15)->create();
        Reserva::factory()->count(100)->create();

        // Criar papéis
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Cliente']);

        // Adicionar papel de administrador ao primeiro usuário
        $user = User::first();
        $user->assignRole('Administrador');
    }
}
