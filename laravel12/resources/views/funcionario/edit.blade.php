@extends('templates.main', [
    'titulo' => 'Editar Funcionário',
    'cabecalho' => 'Editar Funcionário',
    'rota' => '',
    'relatorio' => ''
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
        <label>Turno</label>
        <select name="turno" class="form-select" required>
            @foreach($turnos as $t)
                <option value="{{ $t }}" {{ $func->turno == $t ? 'selected' : '' }}>
                    {{ strtoupper($t) }}
                </option>
            @endforeach
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