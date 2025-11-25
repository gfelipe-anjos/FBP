@extends('templates.main', [
    'titulo' => 'Editar Saída',
    'cabecalho' => 'Editar Saída',
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

<form action="{{ route('saida.update', $saida->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Data e Hora da Saída</label>
        <input type="datetime-local"
               name="data_hora_saida"
               value="{{ date('Y-m-d\TH:i', strtotime($saida->data_hora_saida)) }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Forma de Pagamento</label>
        <select name="forma_pagamento" class="form-select" required>
            <option value="dinheiro" {{ $saida->forma_pagamento == 'dinheiro' ? 'selected' : '' }}>Dinheiro</option>
            <option value="pix" {{ $saida->forma_pagamento == 'pix' ? 'selected' : '' }}>PIX</option>
            <option value="debito" {{ $saida->forma_pagamento == 'debito' ? 'selected' : '' }}>Débito</option>
            <option value="credito" {{ $saida->forma_pagamento == 'credito' ? 'selected' : '' }}>Crédito</option>
        </select>
    </div>

    <button type="submit"
        class="btn btn-atualizar"
        style="background-color: #80bc96; color: #fff; border: none;">
        Salvar
    </button>

    <a href="{{ route('saida.index') }}"
    class="btn ms-2 btn-voltar"
    style="background-color: #f2c14e; color: #000; border: none;">
        Voltar
    </a>
</form>

@endsection