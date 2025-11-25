<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Notas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h1 class="mb-4">Gestor de Notas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('notes.index') }}" class="mb-4 d-flex">
        <select name="category_id" class="form-select me-2">
            <option value="">Todas</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-secondary">Filtrar</button>
    </form>

    <form action="{{ route('notes.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="student_name" class="form-label">Nombre del estudiante</label>
            <input type="text" name="student_name" id="student_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">Sin categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Nota</button>
    </form>

    <h2>Notas</h2>
    <ul class="list-group">
        @forelse($notes as $note)
            <li class="list-group-item">
                <strong>{{ $note->student_name }}</strong>
                <small> | Categoría: {{ $note->category?->name ?? 'Sin categoría' }} | Creada: {{ $note->created_at }}</small>
            </li>
        @empty
            <li class="list-group-item">No hay notas registradas.</li>
        @endforelse
    </ul>

</body>
</html>