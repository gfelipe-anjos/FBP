@extends('templates.main', [
    'titulo' => 'Nova Saída',
    'cabecalho' => 'Registrar Saída',
    'rota' => '',
    'relatorio' => '',
    'class' => App\Models\Saida::class
])

@section('conteudo')

<style>
    .btn-salvar {
        background-color: #80bc96 !important;
        color: #fff !important;
        border: none !important;
    }

    .btn-salvar:hover {
        background-color: #6aa57e !important;
        transform: scale(1.05);
    }

    .btn-voltar {
        background-color: #f2c14e !important;
        color: #000 !important;
        border: none !important;
    }

    .btn-voltar:hover {
        background-color: #d9aa39 !important;
        transform: scale(1.05);
    }
</style>

@if(session('erro'))
    <div class="alert alert-danger">{{ session('erro') }}</div>
@endif

<form action="{{ route('saida.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Entrada</label>
        <select name="entrada_id" class="form-select" required>
            <option value="">Selecione uma entrada</option>
            @foreach($entradas as $entrada)
                <option value="{{ $entrada->id }}">
                    {{ $entrada->motorista->cpf }} - {{ $entrada->motorista->placa }} 
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Data e Hora da Saída</label>
        <input type="datetime-local" name="data_hora_saida" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Forma de Pagamento</label>
        <select name="forma_pagamento" class="form-select" required>
            <option value="dinheiro">Dinheiro</option>
            <option value="pix">PIX</option>
            <option value="debito">Débito</option>
            <option value="credito">Crédito</option>
        </select>
    </div>

    <button type="submit"
        class="btn btn-salvar"
        style="background-color: #80bc96; color: #fff; border: none;">
        Salvar
    </button>

    <a href="{{ route('saida.index') }}"
    class="btn ms-2 btn-voltar"
    style="background-color: #f2c14e; color: #000; border: none;">
        Voltar
    </a>
</form>

@endsection