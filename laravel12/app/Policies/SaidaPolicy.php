<?php

namespace App\Policies;

use App\Models\Funcionario;
use App\Models\Saida;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Controllers\PermissionController;

class SaidaPolicy
{
    use HandlesAuthorization;

    public function viewAny(Funcionario $funcionario): bool {
        return PermissionController::isAuthorized('saida.index');
    }

    public function view(Funcionario $funcionario, Saida $saida): bool {
        return PermissionController::isAuthorized('saida.show');
    }

    public function create(Funcionario $funcionario): bool {
        return PermissionController::isAuthorized('saida.create');
    }

    public function update(Funcionario $funcionario, Saida $saida): bool {
        return PermissionController::isAuthorized('saida.edit');
    }

    public function delete(Funcionario $funcionario, Saida $saida): bool {
        return PermissionController::isAuthorized('saida.delete');
    }
}