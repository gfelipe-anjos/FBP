<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->enum('turno', [
                'gerente',
                'manha_par_entrada','manha_par_saida',
                'manha_impar_entrada','manha_impar_saida',
                'noite_par_entrada','noite_par_saida',
                'noite_impar_entrada','noite_impar_saida'
            ])->default('manha_par_entrada');
            $table->boolean('is_gerente')->default(false);
            $table->string('foto')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('funcionarios');
    }
};