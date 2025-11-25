<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Eventos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h1 class="mb-4">Calendario de Eventos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario de nuevo evento --}}
    <form action="{{ route('events.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Inicio</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">Fin</label>
            <input type="datetime-local" name="end_time" id="end_time" class="form-control" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="reminder" id="reminder" class="form-check-input" value="1">
            <label for="reminder" class="form-check-label">Recordatorio</label>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Evento</button>
    </form>

    {{-- Lista de eventos --}}
    <h2>Eventos programados</h2>
    <ul class="list-group">
        @forelse($events as $event)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $event->title }}</strong><br>
                    <small>{{ $event->start_time }} → {{ $event->end_time }}</small><br>
                    @if($event->reminder)
                        <span class="badge bg-info">Con recordatorio</span>
                    @endif
                </div>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </li>
        @empty
            <li class="list-group-item">No hay eventos programados.</li>
        @endforelse
    </ul>

</body>
</html>