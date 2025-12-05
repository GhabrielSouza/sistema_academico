<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }
    public function run(): void
    {
        // 1. Cria o ADMIN SUPREMO
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@escola.com',
            'password' => bcrypt('12345678'), // Senha padrão
            'role' => 'admin',
        ]);

        // 2. Cria o PROFESSOR DE TESTE
        User::factory()->create([
            'name' => 'Professor Girafales',
            'email' => 'prof@escola.com',
            'password' => bcrypt('12345678'),
            'role' => 'professor',
        ]);

        User::factory()->create([
            'name' => 'Alexandre',
            'email' => 'alexandre@escola.com',
            'password' => bcrypt('12345678'),
            'role' => 'aluno',
        ]);

        // 3. Cria 10 ALUNOS aleatórios (Factories)
        User::factory(10)->create([
            'role' => 'aluno', // Garante que sejam alunos
        ]);
    }
}
