<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('score', 'desc')->get();
        return view('games.index', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'player_name' => 'required|string|max:255',
            'difficulty' => 'required|string',
            'score' => 'required|integer|min:0',
        ]);

        $game = Game::create($request->all());

        return redirect()->route('games.index')->with('success', 'Juego guardado: ' . $game->player_name);
    }
}