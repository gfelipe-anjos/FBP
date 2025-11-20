<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Motorista;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index() {
        $entradas = Entrada::with('motorista')
            ->where('encerrada', false)
            ->orderBy('id','desc')
            ->get();
    
        return view('entrada.index', compact('entradas'));
    }    

    public function create() {
        $motoristas = Motorista::all();
        return view('entrada.create', compact('motoristas'));
    }

    public function store(Request $request) {

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

        return view('entrada.edit', compact('entrada','motoristas'));
    }

    public function update(Request $request, string $id) {

        $entrada = Entrada::find($id);
        $motorista = Motorista::find($request->motorista_id);

        if(isset($entrada) && isset($motorista)) {

            $entrada->motorista()->associate($motorista);
            $entrada->data_hora_entrada = $request->data_hora_entrada;
            $entrada->save();
        }

        return redirect()->route('entrada.index');
    }
}