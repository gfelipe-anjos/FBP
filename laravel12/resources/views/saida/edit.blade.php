@extends('templates.main', [
    'titulo' => 'Editar Saída',
    'cabecalho' => 'Editar Saída',
    'rota' => '',
    'relatorio' => ''
])

@section('conteudo')

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

    <button class="btn btn-secondary">Atualizar</button>
</form>

@endsection