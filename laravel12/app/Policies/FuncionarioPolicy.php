<?php

namespace App\Policies;

use App\Models\Funcionario;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Controllers\PermissionController;

class FuncionarioPolicy
{
    use HandlesAuthorization;

    public function viewAny(Funcionario $funcionario): bool {
        return PermissionController::isAuthorized('funcionario.index');
    }

    public function view(Funcionario $funcionario, Funcionario $model): bool {
        return PermissionController::isAuthorized('funcionario.show');
    }

    public function create(Funcionario $funcionario): bool {
        return PermissionController::isAuthorized('funcionario.create');
    }

    public function update(Funcionario $funcionario, Funcionario $model): bool {
        return PermissionController::isAuthorized('funcionario.edit');
    }

    public function delete(Funcionario $funcionario, Funcionario $model): bool {
        return PermissionController::isAuthorized('funcionario.delete');
    }
}