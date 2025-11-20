<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FuncionarioSeeder extends Seeder
{
    public function run(): void {
        $data = [
            [
                "nome" => "GERENTE GERAL",
                "email" => "gerente@fbp.com",
                "senha" => Hash::make('123456'),
                "turno" => "gerente",
            ],
            [
                "nome" => "FUNCIONARIO ENTRADA", 
                "email" => "entrada@fbp.com",
                "senha" => Hash::make('123456'),
                "turno" => "entrada",
            ],
            [
                "nome" => "FUNCIONARIO SAIDA",
                "email" => "saida@fbp.com", 
                "senha" => Hash::make('123456'),
                "turno" => "saida",
            ],
        ];
        DB::table('funcionarios')->insert($data);
    }
}