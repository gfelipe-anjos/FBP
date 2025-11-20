@extends('templates.main', [
    'titulo' => 'Saídas',
    'cabecalho' => 'Lista de Saídas',
    'rota' => 'saida.create',
    'relatorio' => 'saidas.relatorio'
])

@section('conteudo')

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
                       class="btn btn-sm btn-secondary">
                       Editar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection