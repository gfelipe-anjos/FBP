@extends('templates.main', [
    'titulo' => 'Editar Motorista',
    'cabecalho' => 'Editar Motorista',
    'rota' => '',
    'relatorio' => ''
])

@section('conteudo')

<form action="{{ route('motorista.update', $motorista->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Placa</label>
        <input type="text" name="placa" value="{{ $motorista->placa }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="telefone" value="{{ $motorista->telefone }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="cpf" value="{{ $motorista->cpf }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>CNPJ</label>
        <input type="text" name="cnpj" value="{{ $motorista->cnpj }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tipo Cliente</label>
        <select name="tipo_cliente" class="form-select" required>
            @foreach(['aditivado','premium','power','fidelidade','amigo_aldo','novo'] as $t)
                <option value="{{ $t }}" {{ $motorista->tipo_cliente == $t ? 'selected' : '' }}>
                    {{ strtoupper($t) }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-secondary">Atualizar</button>
</form>

@endsection