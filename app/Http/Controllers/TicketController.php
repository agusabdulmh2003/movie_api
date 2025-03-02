<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return response()->json(Ticket::with('movie')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'customer_name' => 'required',
            'seat_number' => 'required|integer'
        ]);

        $ticket = Ticket::create($request->all());
        return response()->json($ticket, 201);
    }
}
