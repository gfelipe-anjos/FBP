@extends('templates.main', [
    'titulo' => 'Entradas',
    'cabecalho' => 'Lista de Entradas',
    'rota' => 'entrada.create',
    'relatorio' => ''
])

@section('conteudo')

<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead class="table-secondary">
            <tr>
                <th>Motorista</th>
                <th>Placa</th>
                <th>Tipo Cliente</th>
                <th>Data/Hora Entrada</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($entradas as $e)
            <tr>
                <td>{{ $e->motorista->cpf }}</td>
                <td>{{ $e->motorista->placa }}</td>
                <td>{{ strtoupper($e->motorista->tipo_cliente) }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($e->data_hora_entrada)) }}</td>

                <td>
                    <a href="{{ route('entrada.edit', $e->id) }}"
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
