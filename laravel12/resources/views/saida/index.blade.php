@extends('templates.main', [
    'titulo' => 'Saídas',
    'cabecalho' => 'Lista de Saídas',
    'rota' => 'saida.create',
    'relatorio' => 'saidas.relatorio',
    'class' => App\Models\Saida::class
])

@section('conteudo')

<style>
    .btn-editar {
        background-color: #80bc96 !important;
        color: #fff !important;
        border: none !important;
    }

    .btn-editar:hover {
        background-color: #6aa57e !important;
        transform: scale(1.05);
    }
</style>

<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead class="table-secondary">
            <tr>
                <th>Motorista</th>
                <th>Placa</th>
                <th>Entrada</th>
                <th>Saída</th>
                <th>Pagamento</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($saidas as $s)
            <tr>
                <td>{{ $s->motorista->cpf }}</td>
                <td>{{ $s->motorista->placa }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($s->entrada->data_hora_entrada)) }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($s->data_hora_saida)) }}</td>
                <td>{{ strtoupper($s->forma_pagamento) }}</td>
                <td>R$ {{ number_format($s->valor, 2, ',', '.') }}</td>

                <td>
                    <a href="{{ route('saida.edit', $s->id) }}"
                    class="btn btn-sm btn-editar"
                    style="background-color: #80bc96; color: #FFF; border: none;">
                        Editar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection