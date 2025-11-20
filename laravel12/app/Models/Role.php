<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function resources() {
        return $this->belongsToMany(Resource::class, 'permissions');
    }

    public function funcionarios() {
        return $this->hasMany(Funcionario::class);
    }
}