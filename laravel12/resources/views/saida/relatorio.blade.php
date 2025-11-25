<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Pagamentos</title>

    <style>
        body { 
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 0; 
            padding: 0;
        }

        .header {
            width: 70%;
            margin: 0 auto; 
            text-align: center; 
        }

        .logo {
            width: 80%;  
            display: block;
            margin: 0 auto; 
        }

        hr {
            border: none;
            border-top: 2px solid #ddd;
            margin: 10px 0;
        }

        h2 { 
            text-align: center; 
            margin-top: 20px;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }

        th, td { 
            border: 1px solid #444; 
            padding: 6px; 
            text-align: left; 
        }

        th { 
            background: #ddd; 
            font-weight: bold;
        }

        .totais { 
            margin-top: 25px; 
            padding: 15px 20px;
            background-color: #e0e0e0;
            border-radius: 3%;
        }

        .totais h3 { 
            margin-bottom: 5px; 
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('assets/img/logo-pdf.png') }}" class="logo" alt="Logo">
</div>

<hr>

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
