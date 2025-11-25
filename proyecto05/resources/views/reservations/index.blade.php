<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h1 class="mb-4">Sistema de Reservas</h1>

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario de nueva reserva --}}
    <form action="{{ route('reservations.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Nombre</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="customer_email" class="form-label">Correo</label>
            <input type="email" name="customer_email" id="customer_email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="reserved_at" class="form-label">Fecha y hora</label>
            <input type="datetime-local" name="reserved_at" id="reserved_at" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="service" class="form-label">Servicio</label>
            <input type="text" name="service" id="service" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Reservar</button>
    </form>

    {{-- Lista de reservas --}}
    <h2>Reservas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Correo</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->customer_name }}</td>
                    <td>{{ $reservation->customer_email }}</td>
                    <td>{{ $reservation->service }}</td>
                    <td>{{ $reservation->reserved_at }}</td>
                    <td>
                        @if($reservation->confirmed)
                            <span class="badge bg-success">Confirmada</span>
                        @else
                            <span class="badge bg-warning">Pendiente</span>
                        @endif
                    </td>
                    <td>
                        @if(!$reservation->confirmed)
                            <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Confirmar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>