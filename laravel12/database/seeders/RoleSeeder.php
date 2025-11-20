<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void {
        $data = [
            ["name" => "gerente"], // 1
            ["name" => "entrada"], // 2
            ["name" => "saida"],   // 3
        ];
        DB::table('roles')->insert($data);
    }
}