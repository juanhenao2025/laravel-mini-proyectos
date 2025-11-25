<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de Contraseñas Seguras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h1 class="mb-4">Generador de Contraseñas Seguras</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('passwords.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="length" class="form-label">Longitud</label>
            <input type="number" name="length" id="length" class="form-control" value="12" min="6" max="64" required>
        </div>
        <div class="form-check">
            <input type="checkbox" name="include_upper" id="include_upper" value="1" class="form-check-input">
            <label for="include_upper" class="form-check-label">Incluir mayúsculas</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="include_numbers" id="include_numbers" value="1" class="form-check-input">
            <label for="include_numbers" class="form-check-label">Incluir números</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="include_symbols" id="include_symbols" value="1" class="form-check-input">
            <label for="include_symbols" class="form-check-label">Incluir símbolos</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Generar Contraseña</button>
    </form>

    {{-- Historial --}}
    <h2>Historial de contraseñas</h2>
    <ul class="list-group">
        @forelse($passwords as $password)
            <li class="list-group-item">
                <strong>{{ $password->value }}</strong> 
                (Longitud: {{ $password->length }},
                Mayúsculas: {{ $password->include_upper ? 'Sí' : 'No' }},
                Números: {{ $password->include_numbers ? 'Sí' : 'No' }},
                Símbolos: {{ $password->include_symbols ? 'Sí' : 'No' }})
            </li>
        @empty
            <li class="list-group-item">No hay contraseñas generadas aún.</li>
        @endforelse
    </ul>

</body>
</html>