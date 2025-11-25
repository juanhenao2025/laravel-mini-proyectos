<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Memoria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .board { display: grid; grid-template-columns: repeat(4, 100px); gap: 10px; }
        .card { width: 100px; height: 100px; background: #ccc; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 24px; }
        .card.flipped { background: #fff; }
    </style>
</head>
<body class="container py-4">

    <h1 class="mb-4">Juego de Memoria</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario para guardar puntaje --}}
    <form action="{{ route('games.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="player_name" class="form-label">Nombre del jugador</label>
            <input type="text" name="player_name" id="player_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="difficulty" class="form-label">Dificultad</label>
            <select name="difficulty" id="difficulty" class="form-select">
                <option value="facil">Fácil</option>
                <option value="medio">Medio</option>
                <option value="dificil">Difícil</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="score" class="form-label">Puntaje</label>
            <input type="number" name="score" id="score" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Puntaje</button>
    </form>

    {{-- Tablero de juego --}}
    <div class="board" id="board">
        <div class="card" data-value="A">?</div>
        <div class="card" data-value="A">?</div>
        <div class="card" data-value="B">?</div>
        <div class="card" data-value="B">?</div>
        <div class="card" data-value="C">?</div>
        <div class="card" data-value="C">?</div>
        <div class="card" data-value="D">?</div>
        <div class="card" data-value="D">?</div>
    </div>

    <h2 class="mt-4">Ranking</h2>
    <ul class="list-group">
        @forelse($games as $game)
            <li class="list-group-item">
                {{ $game->player_name }} - {{ $game->score }} puntos ({{ $game->difficulty }})
            </li>
        @empty
            <li class="list-group-item">No hay partidas registradas.</li>
        @endforelse
    </ul>

    <script>
        const cards = document.querySelectorAll('.card');
        let flipped = [];
        cards.forEach(card => {
            card.addEventListener('click', () => {
                if (card.classList.contains('flipped')) return;
                card.classList.add('flipped');
                card.textContent = card.dataset.value;
                flipped.push(card);
                if (flipped.length === 2) {
                    if (flipped[0].dataset.value !== flipped[1].dataset.value) {
                        setTimeout(() => {
                            flipped.forEach(c => {
                                c.classList.remove('flipped');
                                c.textContent = '?';
                            });
                            flipped = [];
                        }, 1000);
                    } else {
                        flipped = [];
                    }
                }
            });
        });
    </script>

</body>
</html>