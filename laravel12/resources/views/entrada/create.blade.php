@extends('templates.main', [
    'titulo' => 'Nova Entrada',
    'cabecalho' => 'Registrar Entrada',
    'rota' => '',
    'relatorio' => '',
    'class' => App\Models\Entrada::class
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

<form action="{{ route('entrada.store') }}" method="POST">
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
        <label>Data e Hora da Entrada</label>
        <input type="datetime-local" name="data_hora_entrada" class="form-control" required>
    </div>

    <button type="submit"
        class="btn btn-salvar"
        style="background-color: #80bc96; color: #fff; border: none;">
        Salvar
    </button>

    <a href="{{ route('entrada.index') }}"
    class="btn ms-2 btn-voltar"
    style="background-color: #f2c14e; color: #000; border: none;">
        Voltar
    </a>
</form>

@endsection