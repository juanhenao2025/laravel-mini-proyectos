<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Gastos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h1 class="mb-4">Gestor de Gastos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('expenses.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Monto</label>
            <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <select name="category" id="category" class="form-select" required>
                <option value="Alimentación">Alimentación</option>
                <option value="Transporte">Transporte</option>
                <option value="Servicios">Servicios</option>
                <option value="Otros">Otros</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

    {{-- Lista de gastos --}}
    <h2>Gastos registrados</h2>
    <ul class="list-group mb-4">
        @forelse($expenses as $expense)
            <li class="list-group-item">
                {{ $expense->date }} - <strong>{{ $expense->description }}</strong> 
                ({{ $expense->category }}) → ${{ number_format($expense->amount, 2) }}
            </li>
        @empty
            <li class="list-group-item">No hay gastos registrados.</li>
        @endforelse
    </ul>

    {{-- Resumen mensual --}}
    <h2>Resumen mensual</h2>
    <ul class="list-group">
        @forelse($monthlySummary as $summary)
            <li class="list-group-item">
                {{ $summary->month }} → Total: ${{ number_format($summary->total, 2) }}
            </li>
        @empty
            <li class="list-group-item">No hay datos de resumen.</li>
        @endforelse
    </ul>

</body>
</html>