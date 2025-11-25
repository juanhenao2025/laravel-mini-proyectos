<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Recetas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h1 class="mb-4">Plataforma de Recetas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filtros --}}
    <form method="GET" action="{{ route('recipes.index') }}" class="mb-4 d-flex">
        <input type="text" name="ingredient" class="form-control me-2" placeholder="Buscar por ingrediente...">
        <select name="type" class="form-select me-2">
            <option value="">Todos los tipos</option>
            <option value="Desayuno">Desayuno</option>
            <option value="Almuerzo">Almuerzo</option>
            <option value="Cena">Cena</option>
            <option value="Postre">Postre</option>
        </select>
        <button type="submit" class="btn btn-secondary">Filtrar</button>
    </form>

    {{-- Formulario de nueva receta --}}
    <form action="{{ route('recipes.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredientes</label>
            <textarea name="ingredients" id="ingredients" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="instructions" class="form-label">Instrucciones</label>
            <textarea name="instructions" id="instructions" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo de comida</label>
            <select name="type" id="type" class="form-select">
                <option value="">Selecciona</option>
                <option value="Desayuno">Desayuno</option>
                <option value="Almuerzo">Almuerzo</option>
                <option value="Cena">Cena</option>
                <option value="Postre">Postre</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Autor</label>
            <input type="text" name="author" id="author" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Receta</button>
    </form>

    {{-- Lista de recetas --}}
    <h2>Recetas</h2>
    <ul class="list-group">
        @forelse($recipes as $recipe)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $recipe->title }}</strong><br>
                    <small>Tipo: {{ $recipe->type ?? 'Sin tipo' }} | Autor: {{ $recipe->author ?? 'Anónimo' }}</small><br>
                    <em>Ingredientes:</em> {{ $recipe->ingredients }}<br>
                    <em>Instrucciones:</em> {{ $recipe->instructions }}
                </div>
                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </li>
        @empty
            <li class="list-group-item">No hay recetas registradas.</li>
        @endforelse
    </ul>

</body>
</html>