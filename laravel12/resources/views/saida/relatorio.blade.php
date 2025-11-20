<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Pagamentos</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background: #ddd; }
        h2 { text-align: center; }
        .totais { margin-top: 20px; }
    </style>
</head>
<body>

<h2>Relatório de Pagamentos - Saídas</h2>

<table>
    <thead>
        <tr>
            <th>Motorista</th>
            <th>Placa</th>
            <th>Data Saída</th>
            <th>Pagamento</th>
            <th>Valor (R$)</th>
        </tr>
    </thead>

    <tbody>
        @foreach($saidas as $s)
        <tr>
            <td>{{ $s->motorista->cpf }}</td>
            <td>{{ $s->motorista->placa }}</td>
            <td>{{ date('d/m/Y H:i', strtotime($s->data_hora_saida)) }}</td>
            <td>{{ strtoupper($s->forma_pagamento) }}</td>
            <td>{{ number_format($s->valor, 2, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="totais">
    <h3>Total por Forma de Pagamento:</h3>

    <p><b>PIX:</b> R$ {{ number_format($totalPix, 2, ',', '.') }}</p>
    <p><b>DÉBITO:</b> R$ {{ number_format($totalDebito, 2, ',', '.') }}</p>
    <p><b>CRÉDITO:</b> R$ {{ number_format($totalCredito, 2, ',', '.') }}</p>
    <p><b>DINHEIRO:</b> R$ {{ number_format($totalDinheiro, 2, ',', '.') }}</p>

    <h3>Total Geral:  
        <b>R$ {{ number_format($totalGeral, 2, ',', '.') }}</b>
    </h3>
</div>

</body>
</html>