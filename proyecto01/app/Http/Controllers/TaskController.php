<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        Task::create($data);

        return redirect()->route('tasks.index')->with('ok', 'Tarea agregada');
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'completed' => ['sometimes', 'boolean'],
        ]);

        if ($request->has('completed')) {
            $data['completed'] = (bool)$request->boolean('completed');
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('ok', 'Tarea actualizada');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('ok', 'Tarea eliminada');
    }
}