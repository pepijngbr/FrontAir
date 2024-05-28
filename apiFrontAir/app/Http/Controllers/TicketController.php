<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        return Ticket::all();
    }

    public function store(Request $request)
    {
        return Ticket::create($request->all());
    }

    public function show(Ticket $ticket)
    {
        // return ['ticket' => $ticket, 'user_id' => (int)$request->user_id];
        
        // $foundTicket = Ticket::find($ticket->id);
        // if ($ticket->user_id != $foundTicket->user_id) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        //     if (!$ticket) {
        //         return response()->json(['message' => 'Ticket not found'], 404);
        //     }
        // }
        
        return $ticket;
        return $ticket->user()->get();
    }

    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update($request->all());
        return $ticket;
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }
}
