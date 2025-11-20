@extends('templates.main', [
    'titulo' => 'Novo Funcionário',
    'cabecalho' => 'Cadastrar Funcionário',
    'rota' => '',
    'relatorio' => '',
    'class' => App\Models\Funcionario::class
])

@section('conteudo')

<form action="{{ route('funcionario.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="senha" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Turno</label>
        <select name="turno" class="form-select" required>
            <option value="gerente">Gerente</option>
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Foto (opcional)</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button class="btn btn-secondary">Salvar</button>
</form>

@endsection