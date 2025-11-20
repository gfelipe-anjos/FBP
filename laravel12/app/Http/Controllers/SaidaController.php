<?php

namespace App\Http\Controllers;

use App\Models\Saida;
use App\Models\Entrada;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class SaidaController extends Controller
{
    public function index() {
        Gate::authorize('viewAny', Saida::class);
        
        $saidas = Saida::with(['motorista', 'entrada'])
                        ->orderBy('id','desc')
                        ->get();

        return view('saida.index', compact('saidas'));
    }

    public function create() {
        Gate::authorize('create', Saida::class);
        
        $entradas = Entrada::where('encerrada', false)->get();

        $motoristas = Motorista::all();
        
        return view('saida.create', compact('entradas'));
    }    
    
    public function store(Request $request) {
        Gate::authorize('create', Saida::class);

        $entrada = Entrada::where('id', $request->entrada_id)
                          ->where('encerrada', false)
                          ->first();
    
        if (!$entrada) {
            return redirect()->route('saida.index');
        }
    
        $motorista = $entrada->motorista;
    
        $horaEntrada = Carbon::parse($entrada->data_hora_entrada);
        $horaSaida = Carbon::parse($request->data_hora_saida);
        $horas = $horaEntrada->floatDiffInHours($horaSaida, true);
    
        switch ($motorista->tipo_cliente) {
            case 'aditivado':   $valorHora = 12; break;
            case 'premium':     $valorHora = 24; break;
            case 'power':       $valorHora = 36; break;
            case 'fidelidade':  $valorHora = 48; break;
            case 'amigo_aldo':  $valorHora = 6;  break;
            case 'novo':        $valorHora = 10; break;
            default:            $valorHora = 0;
        }
    
        $valor = $valorHora * $horas;
        if ($motorista->tipo_cliente == "amigo_aldo" && $horas >= 24) {
            $valor = 60;
        }
    
        if ($motorista->tipo_cliente == "novo" && $horas >= 24) {
            $valor = 100;
        }
    
        $saida = new Saida();
        $saida->motorista()->associate($motorista);
        $saida->entrada()->associate($entrada);
        $saida->data_hora_saida = $request->data_hora_saida;
        $saida->forma_pagamento = $request->forma_pagamento;
        $saida->valor = $valor;
        $saida->save();
    
        $entrada->encerrada = true;
        $entrada->save();
    
        return redirect()->route('saida.index');
    }        

    public function edit(string $id) {
        $saida = Saida::find($id);

        if(!isset($saida)) return redirect()->route('saida.index');

        Gate::authorize('update', $saida);

        return view('saida.edit', compact('saida'));
    }

    public function update(Request $request, string $id) {
        $saida = Saida::find($id);

        if(!isset($saida)) {
            return redirect()->route('saida.index');
        }

        Gate::authorize('update', $saida);

        if(isset($saida)) {
            $saida->data_hora_saida = $request->data_hora_saida;
            $saida->forma_pagamento = $request->forma_pagamento;
            $saida->save();
        }

        return redirect()->route('saida.index');
    }

    public function relatorioPagamentosPdf() {
        Gate::authorize('viewAny', Saida::class);
        
        $saidas = Saida::with(['motorista', 'entrada'])->get();

        // Calculando totais
        $totalPix = $saidas->where('forma_pagamento', 'pix')->sum('valor');
        $totalDebito = $saidas->where('forma_pagamento', 'debito')->sum('valor');
        $totalCredito = $saidas->where('forma_pagamento', 'credito')->sum('valor');
        $totalDinheiro = $saidas->where('forma_pagamento', 'dinheiro')->sum('valor');
        $totalGeral = $saidas->sum('valor');

        // Gerando PDF
        $pdf = PDF::loadView('saida.relatorio', compact(
            'saidas',
            'totalPix',
            'totalDebito',
            'totalCredito',
            'totalDinheiro',
            'totalGeral'
        ));

        return $pdf->stream('relatorio_pagamentos.pdf');
    }
}