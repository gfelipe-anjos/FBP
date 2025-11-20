<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrada extends Model
{
    use SoftDeletes;

    protected $fillable = ['motorista_id','data_hora_entrada', 'encerrada'];

    protected $dates = ['data_hora_entrada'];

    public function motorista() {
        return $this->belongsTo(Motorista::class);
    }

    public function saida() {
        return $this->hasOne(Saida::class);
    }
}