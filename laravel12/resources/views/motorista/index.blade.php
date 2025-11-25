@extends('templates.main', [
    'titulo' => 'Motoristas',
    'cabecalho' => 'Lista de Motoristas',
    'rota' => 'motorista.create',
    'relatorio' => '',
    'class' => App\Models\Motorista::class
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

    .btn-remover {
        background-color: #f2c14e !important;
        color: #000 !important;
        border: none !important;
    }

    .btn-remover:hover {
        background-color: #d9aa39 !important;
        transform: scale(1.05);
    }
</style>

<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead class="table-secondary">
            <tr>
                <th>Placa</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>CNPJ</th>
                <th>Tipo Cliente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($motoristas as $m)
            <tr>
                <td>{{ $m->placa }}</td>
                <td>{{ $m->telefone }}</td>
                <td>{{ $m->cpf }}</td>
                <td>{{ $m->cnpj }}</td>
                <td>{{ strtoupper($m->tipo_cliente) }}</td>
                <td>

                    @can('update', $m)
                    <a href="{{ route('motorista.edit', $m->id) }}"
                       class="btn btn-sm btn-editar"
                       style="background-color: #80bc96; color: #fff; border: none;">
                        Editar
                    </a>
                    @endcan

                    @can('delete', $m)
                    <form id="form_{{ $m->id }}"
                          action="{{ route('motorista.destroy', $m->id) }}"
                          method="POST"
                          style="display:inline;">
                        
                        @csrf
                        @method('DELETE')

                        <button type="button"
                                class="btn btn-sm btn-remover"
                                style="background-color: #f2c14e; color: #000; border: none;"
                                onclick="showRemoveModal('{{ $m->id }}','{{ $m->placa }}')">
                            Remover
                        </button>
                    </form>
                    @endcan

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
