<?php

namespace App\Policies;

use App\Models\Funcionario;
use App\Models\Motorista;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Controllers\PermissionController;

class MotoristaPolicy
{
    use HandlesAuthorization;

    public function viewAny(Funcionario $funcionario): bool {
        return PermissionController::isAuthorized('motorista.index');
    }

    public function view(Funcionario $funcionario, Motorista $motorista): bool {
        return PermissionController::isAuthorized('motorista.show');
    }

    public function create(Funcionario $funcionario): bool {
        return PermissionController::isAuthorized('motorista.create');
    }

    public function update(Funcionario $funcionario, Motorista $motorista): bool {
        return PermissionController::isAuthorized('motorista.edit');
    }

    public function delete(Funcionario $funcionario, Motorista $motorista): bool {
        return PermissionController::isAuthorized('motorista.delete');
    }
}