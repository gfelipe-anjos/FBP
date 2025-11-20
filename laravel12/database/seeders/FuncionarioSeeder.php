<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('funcionarios')->insert([
            'nome' => 'Gerente Geral',
            'email' => 'gerenteFBP@gmail.com',
            'senha' => Hash::make('123456'),
            'turno' => 'gerente',
            'is_gerente' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
    }
}
