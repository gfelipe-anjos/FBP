@extends('templates.main', [
    'titulo' => 'Editar Entrada',
    'cabecalho' => 'Editar Entrada',
    'rota' => '',
    'relatorio' => ''
])

@section('conteudo')

<form action="{{ route('entrada.update', $entrada->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Motorista</label>
        <select name="motorista_id" class="form-select" required>
            @foreach($motoristas as $m)
                <option value="{{ $m->id }}" {{ $entrada->motorista_id == $m->id ? 'selected' : '' }}>
                    {{ $m->cpf }} — {{ $m->placa }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Data e Hora da Entrada</label>
        <input type="datetime-local"
               name="data_hora_entrada"
               value="{{ date('Y-m-d\TH:i', strtotime($entrada->data_hora_entrada)) }}"
               class="form-control"
               required>
    </div>

    <button class="btn btn-secondary">Atualizar</button>
</form>

@endsection