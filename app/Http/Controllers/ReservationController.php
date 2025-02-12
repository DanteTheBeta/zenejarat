<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::with(['user', 'concert'])->get(), 200);
    }

    public function show($id)
    {
        $reservation = Reservation::with(['user', 'concert'])->find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }
        return response()->json($reservation, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'concert_id' => 'required|exists:concerts,id',
            'ticket_quantity' => 'required|integer|min:1'
        ]);

        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'concert_id' => 'exists:concerts,id',
            'ticket_quantity' => 'integer|min:1'
        ]);

        $reservation->update($validated);
        return response()->json($reservation, 200);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->delete();
        return response()->json(['message' => 'Reservation deleted successfully'], 200);
    }
}
