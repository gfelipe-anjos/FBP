@extends('templates.main', [
    'titulo' => 'Nova Saída',
    'cabecalho' => 'Registrar Saída',
    'rota' => '',
    'relatorio' => ''
])

@section('conteudo')

@if(session('erro'))
    <div class="alert alert-danger">{{ session('erro') }}</div>
@endif

<form action="{{ route('saida.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Motorista</label>
        <select name="motorista_id" class="form-select" required>
            <option value="">Selecione</option>
            @foreach($motoristas as $m)
                <option value="{{ $m->id }}">
                    {{ $m->cpf }} — {{ $m->placa }}
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

    <button class="btn btn-secondary">Salvar</button>
</form>

@endsection