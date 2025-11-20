<?php

namespace App\Policies;

use App\Models\Funcionario;
use App\Models\Entrada;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Controllers\PermissionController;

class EntradaPolicy
{
    use HandlesAuthorization;

    public function viewAny(Funcionario $funcionario): bool {
        return PermissionController::isAuthorized('entrada.index');
    }

    public function view(Funcionario $funcionario, Entrada $entrada): bool {
        return PermissionController::isAuthorized('entrada.show');
    }

    public function create(Funcionario $funcionario): bool {
        return PermissionController::isAuthorized('entrada.create');
    }

    public function update(Funcionario $funcionario, Entrada $entrada): bool {
        return PermissionController::isAuthorized('entrada.edit');
    }

    public function delete(Funcionario $funcionario, Entrada $entrada): bool {
        return PermissionController::isAuthorized('entrada.delete');
    }
}