<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saida extends Model
{
    use SoftDeletes;

    protected $fillable = ['motorista_id', 'entrada_id', 'valor','data_hora_saida','forma_pagamento'];

    protected $dates = ['data_hora_saida'];

    public function motorista() {
        return $this->belongsTo(Motorista::class);
    }

    public function entrada() {
        return $this->belongsTo(Entrada::class);
    }
}