<?php

namespace App\Http\Controllers;

use App\Models\Saida;
use App\Models\Entrada;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SaidaController extends Controller
{
    public function index() {
        $saidas = Saida::with(['motorista', 'entrada'])
                        ->orderBy('id','desc')
                        ->get();

        return view('saida.index', compact('saidas'));
    }

    public function create() {
        $motoristas = Motorista::all();
        return view('saida.create', compact('motoristas'));
    }
    
    public function store(Request $request) {
        $motorista = Motorista::find($request->motorista_id);
    
        if (!$motorista) {
            return redirect()->route('saida.index')->with('erro', 'Motorista não encontrado.');
        }
    
        $entrada = Entrada::where('motorista_id', $motorista->id)
                          ->where('encerrada', false)
                          ->orderBy('id', 'desc')
                          ->first();
    
        if (!$entrada) {
            return redirect()->route('saida.index')->with('erro', 'Este motorista não possui entrada ativa.');
        }
    
        $horaEntrada = Carbon::parse($entrada->data_hora_entrada);
        $horaSaida = Carbon::parse($request->data_hora_saida);
    
        $horas = $horaEntrada->floatDiffInHours($horaSaida, true);
    
        switch ($motorista->tipo_cliente) {
            case 'aditivado': $valorHora = 12; break;
            case 'premium': $valorHora = 24; break;
            case 'power': $valorHora = 36; break;
            case 'fidelidade': $valorHora = 48; break;
            case 'amigo do aldo': $valorHora = 6; break;
            case 'novo cliente': $valorHora = 10; break;
            default: $valorHora = 0;
        }

        $valor = $valorHora * $horas;
    
        if ($motorista->tipo_cliente == "amigo do aldo" && $horas >= 24) $valor = 60;
        if ($motorista->tipo_cliente == "novo cliente" && $horas >= 24) $valor = 100;
    
        $saida = new Saida();
        $saida->motorista()->associate($motorista);
        $saida->entrada()->associate($entrada);
        $saida->data_hora_saida = $request->data_hora_saida;
        $saida->forma_pagamento = $request->forma_pagamento;
        $saida->valor = $valor;
        $saida->save();
    
        // encerra a entrada
        $entrada->encerrada = true;
        $entrada->save();
    
        return redirect()->route('saida.index');
    }    

    public function edit(string $id) {
        $saida = Saida::find($id);

        if(!isset($saida)) return redirect()->route('saida.index');

        return view('saida.edit', compact('saida'));
    }

    public function update(Request $request, string $id) {
        $saida = Saida::find($id);

        if(isset($saida)) {
            $saida->data_hora_saida = $request->data_hora_saida;
            $saida->forma_pagamento = $request->forma_pagamento;
            $saida->save();
        }

        return redirect()->route('saida.index');
    }

    public function relatorioPagamentosPdf() {
    $saidas = Saida::with(['motorista', 'entrada'])->get();

    // Calculando totais
    $totalPix = $saidas->where('forma_pagamento', 'PIX')->sum('valor');
    $totalDebito = $saidas->where('forma_pagamento', 'DÉBITO')->sum('valor');
    $totalCredito = $saidas->where('forma_pagamento', 'CRÉDITO')->sum('valor');
    $totalDinheiro = $saidas->where('forma_pagamento', 'DINHEIRO')->sum('valor');
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