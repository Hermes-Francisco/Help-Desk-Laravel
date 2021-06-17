<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketController extends Controller
{
    public function create()
    {
        return view('tickets.create');
    }

    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', [
            'ticket' => $ticket
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'gravity' => 'required|numeric|min:1|max:5',
            'urgency' => 'required|numeric|min:1|max:5',
            'tendency' => 'required|numeric|min:1|max:5'
        ]);

        request()->user()->tickets()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'gravity' => $data['gravity'],
            'urgency' => $data['urgency'],
            'tendency' => $data['tendency'],
            'priority' => ($data['gravity'] * $data['urgency'] * $data['tendency']),
            'status' => 'to do'
        ]);

        return redirect(route('dashboard'));
    }
}
