<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lap;

class StopwatchController extends Controller
{
    public function index()
    {
        $laps = Lap::orderBy('created_at', 'desc')->get();
        return view('stopwatch.index', compact('laps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'lap_time' => 'required|string',
        ]);

        Lap::create($request->all());

        return redirect()->route('stopwatch.index')->with('success', 'Vuelta registrada');
    }

    public function destroy($id)
    {
        Lap::findOrFail($id)->delete();
        return redirect()->route('stopwatch.index')->with('success', 'Vuelta eliminada');
    }
}