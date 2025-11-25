<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
</head>
<body>
    <h1>Lista de Tareas</h1>

    <!-- Formulario para agregar -->
    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Nueva tarea" required>
        <button type="submit">Agregar</button>
    </form>

    <hr>

    <!-- Listado de tareas -->
    <ul>
        @foreach ($tasks as $task)
            <li>
                {{ $task->title }}
                
                @if (!$task->completed)
                    <form action="/tasks/{{ $task->id }}/complete" method="POST" style="display:inline;">
                        @csrf
                        <button>Completar</button>
                    </form>
                @else
                    <span>✔ Completada</span>
                @endif

                <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button>Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>

</body>
</html>
