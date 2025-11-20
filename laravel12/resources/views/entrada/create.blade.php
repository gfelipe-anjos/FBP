@extends('templates.main', [
    'titulo' => 'Nova Entrada',
    'cabecalho' => 'Registrar Entrada',
    'rota' => '',
    'relatorio' => ''
])

@section('conteudo')

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

    <button class="btn btn-secondary">Salvar</button>
</form>

@endsection