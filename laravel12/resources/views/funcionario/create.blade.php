@extends('templates.main', [
    'titulo' => 'Novo Funcionário',
    'cabecalho' => 'Cadastrar Funcionário',
    'rota' => '',
    'relatorio' => ''
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
            @foreach($turnos as $t)
                <option value="{{ $t }}">{{ strtoupper($t) }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Foto (opcional)</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button class="btn btn-secondary">Salvar</button>
</form>

@endsection