<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resumo Diário Geral de Vendas</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">

        @php
            use Carbon\Carbon;
            Carbon::setLocale('pt_BR');
            $dataFormatada = Carbon::now()->timezone('America/Sao_Paulo')->translatedFormat('d \d\e F \d\e Y');
        @endphp

        <h1 style="color: #2c3e50; font-size: 20px;">Resumo Diário Geral de Vendas</h1>
        <p>Olá <strong>{{ $adminName }}</strong>,</p>

        <p>Aqui está o resumo geral das vendas em <strong>{{ $dataFormatada }}</strong>:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">Total de Vendas</td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">{{ $totalSales }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">Valor Total</td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">R$ {{ number_format($totalAmount, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">Comissão Total</td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">R$ {{ number_format($totalCommission, 2, ',', '.') }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">Esse é o consolidado do dia.</p>
    </div>
</body>
</html>
