<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tip Calculator</title>
</head>
<body>

    <h1>Tip Calculator</h1>

    <form action="{{ route('tip.calculate') }}" method="POST">
        @csrf

        <label>Monto de la cuenta:</label>
        <input type="number" name="amount" step="0.01" required value="{{ $amount ?? '' }}"><br><br>

        <label>Porcentaje de propina (%):</label>
        <input type="number" name="percentage" required value="{{ $percentage ?? '' }}"><br><br>

        <button type="submit">Calcular</button>
    </form>

    @isset($tip)
        <hr>
        <h3>Resultados:</h3>
        <p>Propina: ${{ number_format($tip, 2) }}</p>
        <p>Total a pagar: ${{ number_format($total, 2) }}</p>
    @endisset

</body>
</html>
