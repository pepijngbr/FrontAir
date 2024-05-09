<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::all();
    }

    public function store(Request $request)
    {
        return Ticket::create($request->all());
    }

    public function show(Ticket $ticket)
    {
        return $ticket;
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
