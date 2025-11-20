<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('motorista_id');
            $table->foreign('motorista_id')->references('id')->on('motoristas');
            $table->dateTime('data_hora_entrada');
            $table->boolean('encerrada')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });        
    }

    public function down(): void
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->dropColumn('encerrada');
        });
    }
};
