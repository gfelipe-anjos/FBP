@extends('templates.main', [
    'titulo' => 'Editar Funcionário',
    'cabecalho' => 'Editar Funcionário',
    'rota' => '',
    'relatorio' => '',
    'class' => App\Models\Funcionario::class
])

@section('conteudo')

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

    <button class="btn btn-secondary">Atualizar</button>
</form>

@endsection