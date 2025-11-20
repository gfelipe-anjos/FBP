<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorista extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome','placa','cpf','cnpj','telefone','tipo_cliente'];
    
    public function entradas() {
        return $this->hasMany(Entrada::class);
    }

    public function saídas() {
        return $this->hasMany(Saida::class);
    }
}