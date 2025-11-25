<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cronómetro Online</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .time { font-size: 3rem; margin-bottom: 20px; }
    </style>
</head>
<body class="container py-4">

    <h1 class="mb-4">Cronómetro Online</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="time" id="display">00:00:00</div>

    <div class="mb-3">
        <button class="btn btn-success" onclick="start()">Iniciar</button>
        <button class="btn btn-warning" onclick="pause()">Pausar</button>
        <button class="btn btn-danger" onclick="reset()">Reiniciar</button>
        <button class="btn btn-info" onclick="lap()">Registrar Vuelta</button>
    </div>

    <form id="lapForm" action="{{ route('stopwatch.store') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="user_name" value="Juan">
        <input type="hidden" name="lap_time" id="lap_time">
    </form>

    <h2>Vueltas registradas</h2>
    <ul class="list-group">
        @forelse($laps as $lap)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $lap->user_name }}</strong> → {{ $lap->lap_time }}
                </div>
                <form action="{{ route('stopwatch.destroy', $lap->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </li>
        @empty
            <li class="list-group-item">No hay vueltas registradas.</li>
        @endforelse
    </ul>

    <script>
        let startTime, updatedTime, difference, tInterval;
        let running = false;

        function start() {
            if (!running) {
                startTime = new Date().getTime() - (difference || 0);
                tInterval = setInterval(updateTime, 1000);
                running = true;
            }
        }

        function pause() {
            if (running) {
                clearInterval(tInterval);
                difference = new Date().getTime() - startTime;
                running = false;
            }
        }

        function reset() {
            clearInterval(tInterval);
            document.getElementById("display").innerHTML = "00:00:00";
            difference = 0;
            running = false;
        }

        function updateTime() {
            updatedTime = new Date().getTime() - startTime;
            let hours = Math.floor((updatedTime / (1000 * 60 * 60)) % 24);
            let minutes = Math.floor((updatedTime / (1000 * 60)) % 60);
            let seconds = Math.floor((updatedTime / 1000) % 60);

            document.getElementById("display").innerHTML =
                (hours < 10 ? "0" + hours : hours) + ":" +
                (minutes < 10 ? "0" + minutes : minutes) + ":" +
                (seconds < 10 ? "0" + seconds : seconds);
        }

        function lap() {
            let currentTime = document.getElementById("display").innerHTML;
            document.getElementById("lap_time").value = currentTime;
            document.getElementById("lapForm").submit();
        }
    </script>

</body>
</html>