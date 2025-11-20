@extends('templates.main', [
    'titulo' => 'Novo Motorista',
    'cabecalho' => 'Cadastrar Motorista',
    'rota' => '',
    'relatorio' => '',
    'class' => App\Models\Motorista::class
])

@section('conteudo')

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

    <button class="btn btn-secondary">Salvar</button>
</form>

@endsection