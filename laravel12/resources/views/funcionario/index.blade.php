@extends('templates.main', [
    'titulo' => 'Funcionários',
    'cabecalho' => 'Lista de Funcionários',
    'rota' => 'funcionario.create',
    'relatorio' => ''
])

@section('conteudo')

<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead class="table-secondary">
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Turno</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($funcionarios as $f)
            <tr>
                <td>
                    @if($f->foto)
                    <img src="{{ asset('storage/'.$f->foto) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">

                    @else
                        -
                    @endif
                </td>
                <td>{{ $f->nome }}</td>
                <td>{{ $f->email }}</td>
                <td>{{ $f->turno }}</td>
                <td>
                    <a href="{{ route('funcionario.edit', $f->id) }}" class="btn btn-sm btn-secondary">Editar</a>

                    <form id="form_{{ $f->id }}" action="{{ route('funcionario.destroy', $f->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" onclick="showRemoveModal('{{ $f->id }}','{{ $f->nome }}')">Remover</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
