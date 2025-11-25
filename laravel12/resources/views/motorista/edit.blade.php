@extends('templates.main', [
    'titulo' => 'Editar Motorista',
    'cabecalho' => 'Editar Motorista',
    'rota' => '',
    'relatorio' => ''
])

@section('conteudo')

<style>
    .btn-atualizar {
        background-color: #80bc96 !important;
        color: #fff !important;
        border: none !important;
    }

    .btn-atualizar:hover {
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

    <button type="submit"
        class="btn btn-atualizar"
        style="background-color: #80bc96; color: #fff; border: none;">
        Atualizar
    </button>

    <a href="{{ route('motorista.index') }}"
    class="btn ms-2 btn-voltar"
    style="background-color: #f2c14e; color: #000; border: none;">
        Voltar
    </a>
</form>

@endsection