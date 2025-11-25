<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Category;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::query();

        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $notes = $query->orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('notes.index', compact('notes', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $note = Note::create($request->only('student_name', 'category_id'));

        return redirect()->route('notes.index')
            ->with('success', 'Nota guardada: ' . $note->student_name . ' en ' . ($note->category->name ?? 'Sin categoría'));
    }
}