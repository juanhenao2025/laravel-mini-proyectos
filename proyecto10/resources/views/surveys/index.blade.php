<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Encuestas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h1 class="mb-4">{{ $survey->title }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario de encuesta --}}
    <form action="{{ route('surveys.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="user_name" class="form-label">Tu nombre</label>
            <input type="text" name="user_name" id="user_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">1. ¿Qué tan satisfecho estás con el servicio?</label>
            <select name="q1" class="form-select" required>
                <option value="Muy satisfecho">Muy satisfecho</option>
                <option value="Satisfecho">Satisfecho</option>
                <option value="Neutral">Neutral</option>
                <option value="Insatisfecho">Insatisfecho</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">2. ¿Recomendarías este servicio?</label>
            <select name="q2" class="form-select" required>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">3. ¿Cómo calificarías la atención recibida?</label>
            <select name="q3" class="form-select" required>
                <option value="Excelente">Excelente</option>
                <option value="Buena">Buena</option>
                <option value="Regular">Regular</option>
                <option value="Mala">Mala</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">4. ¿Qué tan fácil fue usar la plataforma?</label>
            <select name="q4" class="form-select" required>
                <option value="Muy fácil">Muy fácil</option>
                <option value="Fácil">Fácil</option>
                <option value="Difícil">Difícil</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">5. ¿Volverías a usar este servicio?</label>
            <select name="q5" class="form-select" required>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
    </form>

    {{-- Resultados --}}
    <h2>Respuestas registradas</h2>
    <ul class="list-group">
        @forelse($responses as $response)
            <li class="list-group-item">
                <strong>{{ $response->user_name }}</strong> → 
                [Q1: {{ $response->q1 }} | Q2: {{ $response->q2 }} | Q3: {{ $response->q3 }} | Q4: {{ $response->q4 }} | Q5: {{ $response->q5 }}]
            </li>
        @empty
            <li class="list-group-item">No hay respuestas aún.</li>
        @endforelse
    </ul>

</body>
</html>