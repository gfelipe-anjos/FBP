<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MotoristaController extends Controller
{
    public function index() {
        Gate::authorize('viewAny', Motorista::class);
        
        $motoristas = Motorista::orderBy('id','desc')->get();
        return view('motorista.index', compact('motoristas'));
    }

    public function create() {
        Gate::authorize('create', Motorista::class);
        
        return view('motorista.create');
    }

    public function store(Request $request) {
        Gate::authorize('create', Motorista::class);

        $request->validate([
            'placa' => 'required|unique:motoristas,placa',
            'cpf' => 'nullable|string|max:20',
            'cnpj' => 'nullable|string|max:20',
            'telefone' => 'required|string|max:30',
            'tipo_cliente' => 'required|string'
        ]);

        $motorista = new Motorista();
        $motorista->placa = mb_strtoupper($request->placa, 'UTF-8');
        $motorista->cpf = $request->cpf;
        $motorista->cnpj = $request->cnpj;
        $motorista->telefone = $request->telefone;
        $motorista->tipo_cliente = $request->tipo_cliente;
        $motorista->save();

        return redirect()->route('motorista.index');
    }

    public function edit(string $id) {
        $motorista = Motorista::find($id);

        if(!isset($motorista)) {
            return redirect()->route('motorista.index');
        }

        Gate::authorize('update', $motorista);

        return view('motorista.edit', compact('motorista'));
    }

    public function update(Request $request, string $id) {
        $motorista = Motorista::find($id);

        if(!isset($motorista)) {
            return redirect()->route('motorista.index');
        }

        Gate::authorize('update', $motorista);

        $request->validate([
            'placa' => 'required|unique:motoristas,placa,'.$motorista->id,
            'cpf' => 'nullable|string|max:20',
            'cnpj' => 'nullable|string|max:20',
            'telefone' => 'required|string|max:30',
            'tipo_cliente' => 'required|string'
        ]);

        $motorista->placa = mb_strtoupper($request->placa, 'UTF-8');
        $motorista->cpf = $request->cpf;
        $motorista->cnpj = $request->cnpj;
        $motorista->telefone = $request->telefone;
        $motorista->tipo_cliente = $request->tipo_cliente;

        $motorista->save();

        return redirect()->route('motorista.index');
    }

    public function destroy(string $id) {
        $motorista = Motorista::find($id);

        if (!isset($motorista)) {
            return redirect()->route('motorista.index');
        }

        Gate::authorize('delete', $motorista);

        foreach ($motorista->entradas as $entrada) {
            $entrada->encerrada = true;
            $entrada->save();
        }

        $motorista->delete();

        return redirect()->route('motorista.index');
    }
}