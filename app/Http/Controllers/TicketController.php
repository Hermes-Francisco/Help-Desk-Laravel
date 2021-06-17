<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Validation\Rule;

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
        $data = $this->rules();

        $data['priority'] = ($data['gravity'] * $data['urgency'] * $data['tendency']);
        $data['status'] = 'to do';

        request()->user()->tickets()->create($data);

        return redirect(route('dashboard'));
    }

    public function update(Ticket $ticket)
    {
        $data = $this->rules();
        $data['priority'] = ($data['gravity'] * $data['urgency'] * $data['tendency']);

        $ticket->update($data);
    }

    public function rules()
    {
        if(request('responsible_id'))$this->authorize('edit_responsability');

        return request()->validate([
            'title' => 'required',
            'description' => 'required',
            'gravity' => 'required|numeric|min:1|max:5',
            'urgency' => 'required|numeric|min:1|max:5',
            'tendency' => 'required|numeric|min:1|max:5',
            'responsible_id' => 'nullable|user:exists',
            'status' => ['nullable', Rule::in(['to do', 'in progress', 'delayed', 'done'])],
            'due' => 'nullable|date'
        ]);
    }
}
