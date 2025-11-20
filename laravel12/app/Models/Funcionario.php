<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Funcionario extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $fillable = ['nome', 'email', 'senha', 'turno', 'foto'];
    protected $hidden = ['senha'];

    public function getAuthPassword() {
        return $this->senha;
    }

    // Método para obter o role_id baseado no turno
    public function getRoleIdAttribute() {
        $turnoToRoleId = [
            'gerente' => 1,
            'entrada' => 2, 
            'saida' => 3
        ];
        return $turnoToRoleId[$this->turno] ?? 1;
    }
}