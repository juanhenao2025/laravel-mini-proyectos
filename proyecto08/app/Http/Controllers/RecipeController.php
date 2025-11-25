<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        // Filtrar por tipo de comida
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        // Buscar por ingrediente
        if ($request->has('ingredient') && $request->ingredient) {
            $query->where('ingredients', 'like', '%' . $request->ingredient . '%');
        }

        $recipes = $query->orderBy('created_at', 'desc')->get();

        return view('recipes.index', compact('recipes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'type' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        $recipe = Recipe::create($request->all());

        return redirect()->route('recipes.index')
            ->with('success', 'Receta guardada: ' . $recipe->title);
    }

    public function destroy($id)
    {
        Recipe::findOrFail($id)->delete();
        return redirect()->route('recipes.index')->with('success', 'Receta eliminada');
    }
}