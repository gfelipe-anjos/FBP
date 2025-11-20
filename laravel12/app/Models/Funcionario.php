<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome','email','senha','turno','is_gerente'];

    protected $hidden = ['senha'];
}