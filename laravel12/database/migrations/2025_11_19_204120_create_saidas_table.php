<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saidas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('motorista_id');
            $table->foreign('motorista_id')
                  ->references('id')->on('motoristas');

            $table->unsignedBigInteger('entrada_id');
            $table->foreign('entrada_id')
                  ->references('id')->on('entradas');

            $table->dateTime('data_hora_saida');
            $table->enum('forma_pagamento', ['pix', 'debito', 'credito', 'dinheiro']);
            $table->decimal('valor', 8, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saidas');
    }
};