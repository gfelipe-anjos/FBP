@extends('templates.main', [
    'titulo' => 'Editar Funcionário',
    'cabecalho' => 'Editar Funcionário',
    'rota' => '',
    'relatorio' => '',
    'class' => App\Models\Funcionario::class
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

<form action="{{ route('funcionario.update', $func->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" value="{{ $func->nome }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $func->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Nova Senha (deixe em branco para manter a atual)</label>
        <input type="password" name="senha" class="form-control">
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
        <label>Foto (opcional)</label><br>
        @if($func->foto)
            <img src="{{ asset('storage/'.$func->foto) }}" width="80" class="rounded mb-2"><br>
        @endif
        <input type="file" name="foto" class="form-control">
    </div>

    <button type="submit"
        class="btn btn-atualizar"
        style="background-color: #80bc96; color: #fff; border: none;">
        Atualizar
    </button>

    <a href="{{ route('funcionario.index') }}"
    class="btn ms-2 btn-voltar"
    style="background-color: #f2c14e; color: #000; border: none;">
        Voltar
    </a>
</form>

@endsection