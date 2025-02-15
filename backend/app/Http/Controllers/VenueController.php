<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;

class VenueController extends Controller
{
    public function index()
    {
        return response()->json(Venue::all(), 200);
    }

    public function show($id)
    {
        $venue = Venue::find($id);
        if (!$venue) {
            return response()->json(['message' => 'Venue not found'], 404);
        }
        return response()->json($venue, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:255'
        ]);

        $venue = Venue::create($validated);
        return response()->json($venue, 201);
    }

    public function update(Request $request, $id)
    {
        $venue = Venue::find($id);
        if (!$venue) {
            return response()->json(['message' => 'Venue not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:100',
            'location' => 'string|max:255'
        ]);

        $venue->update($validated);
        return response()->json($venue, 200);
    }

    public function destroy($id)
    {
        $venue = Venue::find($id);
        if (!$venue) {
            return response()->json(['message' => 'Venue not found'], 404);
        }

        $venue->delete();
        return response()->json(['message' => 'Venue deleted successfully'], 200);
    }
}