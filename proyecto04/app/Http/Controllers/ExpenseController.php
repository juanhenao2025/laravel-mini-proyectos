<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::orderBy('date', 'desc')->get();

        // Resumen mensual
        $monthlySummary = Expense::selectRaw('strftime("%Y-%m", date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        return view('expenses.index', compact('expenses', 'monthlySummary'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|in:Alimentación,Transporte,Servicios,Otros',
            'date' => 'required|date',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')->with('success', 'Gasto guardado correctamente');
    }
}