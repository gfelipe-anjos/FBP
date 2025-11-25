@extends('templates.main', [
    'titulo' => 'Novo Funcionário',
    'cabecalho' => 'Cadastrar Funcionário',
    'rota' => '',
    'relatorio' => '',
    'class' => App\Models\Funcionario::class
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

    <button type="submit"
        class="btn btn-salvar"
        style="background-color: #80bc96; color: #fff; border: none;">
        Salvar
    </button>

    <a href="{{ route('funcionario.index') }}"
    class="btn ms-2 btn-voltar"
    style="background-color: #f2c14e; color: #000; border: none;">
        Voltar
    </a>

</form>

@endsection