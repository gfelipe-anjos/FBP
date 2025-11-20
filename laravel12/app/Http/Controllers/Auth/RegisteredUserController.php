<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Events\AuthenticationEvent;

class RegisteredUserController extends Controller
{
    public function create(): View {
        return view('auth.register');
    }

   public function store(Request $request): RedirectResponse {
    $request->validate([
        'nome' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Funcionario::class],
        'turno' => ['required', 'in:gerente,entrada,saida'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = Funcionario::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'turno' => $request->turno,
        'senha' => Hash::make($request->password),
    ]);

    event(new Registered($user));
    Auth::guard('funcionario')->login($user);

    event(new AuthenticationEvent(Auth::guard('funcionario')->user()->turno));

    return redirect(route('home', absolute: false));
}
}