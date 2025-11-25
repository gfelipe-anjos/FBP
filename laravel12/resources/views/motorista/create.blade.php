@extends('templates.main', [
    'titulo' => 'Novo Motorista',
    'cabecalho' => 'Cadastrar Motorista',
    'rota' => '',
    'relatorio' => '',
    'class' => App\Models\Motorista::class
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

<form action="{{ route('motorista.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Placa</label>
        <input type="text" name="placa" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="telefone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="cpf" class="form-control">
    </div>

    <div class="mb-3">
        <label>CNPJ</label>
        <input type="text" name="cnpj" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tipo Cliente</label>
        <select name="tipo_cliente" class="form-select" required>
            <option value="aditivado">Aditivado</option>
            <option value="premium">Premium</option>
            <option value="power">Power</option>
            <option value="fidelidade">Fidelidade</option>
            <option value="amigo_aldo">Amigo Aldo</option>
            <option value="novo">Novo Cliente</option>
        </select>
    </div>

    <button type="submit"
        class="btn btn-salvar"
        style="background-color: #80bc96; color: #fff; border: none;">
        Salvar
    </button>

    <a href="{{ route('motorista.index') }}"
    class="btn ms-2 btn-voltar"
    style="background-color: #f2c14e; color: #000; border: none;">
        Voltar
    </a>
</form>

@endsection