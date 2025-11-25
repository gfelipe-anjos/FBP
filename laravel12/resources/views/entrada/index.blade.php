@extends('templates.main', [
    'titulo' => 'Entradas',
    'cabecalho' => 'Lista de Entradas',
    'rota' => 'entrada.create',
    'relatorio' => '',
    'class' => App\Models\Entrada::class
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
