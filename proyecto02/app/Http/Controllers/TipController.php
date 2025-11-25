<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index()
    {
        return view('tip-calculator');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'percentage' => 'required|numeric|min:0',
        ]);

        $amount = (float) $request->amount;
        $percentage = (float) $request->percentage;

        $tip = round($amount * ($percentage / 100), 2);
        $total = round($amount + $tip, 2);

        return view('tip-calculator', compact('amount', 'percentage', 'tip', 'total'));
    }
}
