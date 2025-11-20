<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Funcionario;
use App\Models\Motorista;
use App\Models\Entrada;
use App\Models\Saida;
use App\Policies\FuncionarioPolicy;
use App\Policies\MotoristaPolicy;
use App\Policies\EntradaPolicy;
use App\Policies\SaidaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Funcionario::class => FuncionarioPolicy::class,
        Motorista::class => MotoristaPolicy::class,
        Entrada::class => EntradaPolicy::class,
        Saida::class => SaidaPolicy::class,
    ];

    public function boot(): void {
        $this->registerPolicies();
    }
}