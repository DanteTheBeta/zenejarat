<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;


class ConcertController extends Controller
{
    
    public function index()
    {
        return response()->json(Concert::with('venue')->get(), 200);
    }

    
    public function show($id)
    {
        $concert = Concert::with('venue')->find($id);

        if (!$concert) {
            return response()->json(['message' => 'Concert not found'], 404);
        }

        return response()->json($concert, 200);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'date' => 'required|date',
            'venue_id' => 'nullable|exists:venues,id',
            'ticket' => 'required|integer|min:0'
        ]);

        $concert = Concert::create($validated);

        return response()->json($concert, 201);
    }

    
    public function update(Request $request, $id)
    {
        $concert = Concert::find($id);

        if (!$concert) {
            return response()->json(['message' => 'Concert not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:100',
            'date' => 'date',
            'venue_id' => 'nullable|exists:venues,id',
            'ticket' => 'integer|min:0'
        ]);

        $concert->update($validated);

        return response()->json($concert, 200);
    }

    
    public function destroy($id)
    {
        $concert = Concert::find($id);

        if (!$concert) {
            return response()->json(['message' => 'Concert not found'], 404);
        }

        $concert->delete();

        return response()->json(['message' => 'Concert deleted successfully'], 200);
    }
}