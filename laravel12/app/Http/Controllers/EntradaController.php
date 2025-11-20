<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EntradaController extends Controller
{
    public function index() {
        Gate::authorize('viewAny', Entrada::class);
        
        $entradas = Entrada::with('motorista')
            ->where('encerrada', false)
            ->orderBy('id','desc')
            ->get();
    
        return view('entrada.index', compact('entradas'));
    }    

    public function create() {
        Gate::authorize('create', Entrada::class);
        
        $motoristas = Motorista::all();
        return view('entrada.create', compact('motoristas'));
    }

    public function store(Request $request) {
        Gate::authorize('create', Entrada::class);

        $motorista = Motorista::find($request->motorista_id);

        if(isset($motorista)) {
            $entrada = new Entrada();
            $entrada->motorista()->associate($motorista);
            $entrada->data_hora_entrada = $request->data_hora_entrada;
            $entrada->save();
        }

        return redirect()->route('entrada.index');
    }

    public function edit(string $id) {
        $entrada = Entrada::find($id);
        $motoristas = Motorista::all();

        if(!isset($entrada)) {
            return redirect()->route('entrada.index');
        }

        Gate::authorize('update', $entrada);

        return view('entrada.edit', compact('entrada','motoristas'));
    }

    public function update(Request $request, string $id) {
        $entrada = Entrada::find($id);
        $motorista = Motorista::find($request->motorista_id);

        if(!isset($entrada)) {
            return redirect()->route('entrada.index');
        }

        Gate::authorize('update', $entrada);

        if(isset($entrada) && isset($motorista)) {
            $entrada->motorista()->associate($motorista);
            $entrada->data_hora_entrada = $request->data_hora_entrada;
            $entrada->save();
        }

        return redirect()->route('entrada.index');
    }
}