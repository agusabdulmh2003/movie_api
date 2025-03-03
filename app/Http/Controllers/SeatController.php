<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;

class SeatController extends Controller
{
    public function index()
    {
        return response()->json(Seat::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'seat_number' => 'required|unique:seats',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $seat = Seat::create($request->all());
        return response()->json($seat, 201);
    }

    public function update(Request $request, $id)
    {
        $seat = Seat::find($id);
        if (!$seat) {
            return response()->json(['message' => 'Seat not found'], 404);
        }

        $seat->update($request->all());
        return response()->json($seat, 200);
    }

    public function destroy($id)
    {
        $seat = Seat::find($id);
        if (!$seat) {
            return response()->json(['message' => 'Seat not found'], 404);
        }

        $seat->delete();
        return response()->json(['message' => 'Seat deleted successfully'], 200);
    }
}
