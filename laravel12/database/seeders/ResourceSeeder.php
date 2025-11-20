<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    public function run(): void {
        $data = [
            // FUNCIONARIO
            ["name" => "funcionario.index"],  // 1
            ["name" => "funcionario.create"], // 2
            ["name" => "funcionario.show"],   // 3
            ["name" => "funcionario.edit"],   // 4
            ["name" => "funcionario.delete"], // 5
            // MOTORISTA
            ["name" => "motorista.index"],    // 6
            ["name" => "motorista.create"],   // 7
            ["name" => "motorista.show"],     // 8
            ["name" => "motorista.edit"],     // 9
            ["name" => "motorista.delete"],   // 10
            // ENTRADA
            ["name" => "entrada.index"],      // 11
            ["name" => "entrada.create"],     // 12
            ["name" => "entrada.show"],       // 13
            ["name" => "entrada.edit"],       // 14
            // SAIDA
            ["name" => "saida.index"],        // 15
            ["name" => "saida.create"],       // 16
            ["name" => "saida.show"],         // 17
            ["name" => "saida.edit"],         // 18
        ];
        DB::table('resources')->insert($data);
    }
}