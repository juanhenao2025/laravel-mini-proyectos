<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de tareas</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 24px; }
        h1 { margin-bottom: 12px; }
        form { display: inline; }
        .task { display: flex; align-items: center; gap: 12px; padding: 8px 0; border-bottom: 1px solid #eee; }
        .task.completed .title { text-decoration: line-through; color: #888; }
        .row { margin: 16px 0; }
        .flash { color: green; }
    </style>
</head>
<body>
    <h1>Lista de tareas</h1>

    @if(session('ok'))
        <p class="flash">{{ session('ok') }}</p>
    @endif

    <div class="row">
        <form method="post" action="{{ route('tasks.store') }}">
            @csrf
            <input type="text" name="title" placeholder="Nueva tarea" required>
            <button type="submit">Agregar</button>
        </form>
    </div>

    <div>
        @forelse($tasks as $task)
            <div class="task {{ $task->completed ? 'completed' : '' }}">
                <form method="post" action="{{ route('tasks.update', $task) }}">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="completed" value="1" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                </form>

                <span class="title">{{ $task->title }}</span>

                <form method="post" action="{{ route('tasks.destroy', $task) }}" style="margin-left:auto;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar esta tarea?')">Eliminar</button>
                </form>
            </div>
        @empty
            <p>No hay tareas aún. Agrega una arriba.</p>
        @endforelse
    </div>
</body>
</html>