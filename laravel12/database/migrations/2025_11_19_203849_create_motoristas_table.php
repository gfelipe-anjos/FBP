<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motoristas', function (Blueprint $table) {
            $table->id();
            $table->string('placa')->unique();
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('telefone');
            $table->enum('tipo_cliente', [
                'aditivado', 'premium', 'power', 'fidelidade',
                'amigo_aldo', 'novo'
            ])->default('novo');
            $table->softDeletes();
            $table->timestamps();
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('motoristas');
    }
};
