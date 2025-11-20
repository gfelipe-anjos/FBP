<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void {
        $data = [
            // GERENTE - TODAS AS PERMISSÕES
            ["role_id" => 1, "resource_id" => 1, "permission" => 1],
            ["role_id" => 1, "resource_id" => 2, "permission" => 1],
            ["role_id" => 1, "resource_id" => 3, "permission" => 1],
            ["role_id" => 1, "resource_id" => 4, "permission" => 1],
            ["role_id" => 1, "resource_id" => 5, "permission" => 1],
            ["role_id" => 1, "resource_id" => 6, "permission" => 1],
            ["role_id" => 1, "resource_id" => 7, "permission" => 1],
            ["role_id" => 1, "resource_id" => 8, "permission" => 1],
            ["role_id" => 1, "resource_id" => 9, "permission" => 1],
            ["role_id" => 1, "resource_id" => 10, "permission" => 1],
            ["role_id" => 1, "resource_id" => 11, "permission" => 1],
            ["role_id" => 1, "resource_id" => 12, "permission" => 1],
            ["role_id" => 1, "resource_id" => 13, "permission" => 1],
            ["role_id" => 1, "resource_id" => 14, "permission" => 1],
            ["role_id" => 1, "resource_id" => 15, "permission" => 1],
            ["role_id" => 1, "resource_id" => 16, "permission" => 1],
            ["role_id" => 1, "resource_id" => 17, "permission" => 1],
            ["role_id" => 1, "resource_id" => 18, "permission" => 1],

            // ENTRADA - APENAS ENTRADAS
            ["role_id" => 2, "resource_id" => 6, "permission" => 1],
            ["role_id" => 2, "resource_id" => 7, "permission" => 1],
            ["role_id" => 2, "resource_id" => 8, "permission" => 1],
            ["role_id" => 2, "resource_id" => 9, "permission" => 1],
            ["role_id" => 2, "resource_id" => 11, "permission" => 1],
            ["role_id" => 2, "resource_id" => 12, "permission" => 1],
            ["role_id" => 2, "resource_id" => 13, "permission" => 1],
            ["role_id" => 2, "resource_id" => 14, "permission" => 1],

            // SAIDA - APENAS SAIDAS
            ["role_id" => 3, "resource_id" => 15, "permission" => 1],
            ["role_id" => 3, "resource_id" => 16, "permission" => 1],
            ["role_id" => 3, "resource_id" => 17, "permission" => 1],
            ["role_id" => 3, "resource_id" => 18, "permission" => 1],
        ];
        DB::table('permissions')->insert($data);
    }
}