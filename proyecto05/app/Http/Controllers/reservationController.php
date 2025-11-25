<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('reserved_at', 'asc')->get();
        return view('reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'reserved_at' => 'required|date',
            'service' => 'required|string|max:255',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reserva creada correctamente');
    }

    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->confirmed = true;
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reserva confirmada');
    }
}