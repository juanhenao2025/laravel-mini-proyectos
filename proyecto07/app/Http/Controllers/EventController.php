<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_time')->get();
        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'reminder' => 'nullable|boolean',
        ]);

        $event = Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Evento creado: ' . $event->title);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado');
    }
}