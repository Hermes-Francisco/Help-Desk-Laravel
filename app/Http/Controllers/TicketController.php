<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function show(Ticket $ticket): View
    {
        $this->authorize('view', $ticket);
        return view('tickets.show', ['ticket' => $ticket]);
    }

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

        if(request('responsible')){
            $this->authorize('edit_responsibility');
            $data['responsible_id'] = (int)explode(" - ", request('responsible'))[0];
        }

        $data['priority'] = ($data['gravity'] * $data['urgency'] * $data['tendency']);
        $data['status'] = 'to do';

        $ticket = request()->user()->tickets()->create($data);

        return redirect()
        ->route('ticket.show', $ticket)
        ->with(['success' => 'Chamado criado com sucesso!']);
    }

    public function update(Ticket $ticket)
    {
        $data = $this->rules();

        if(request('responsible')){
            $this->authorize('edit_responsibility');
            $data['responsible_id'] = (int)explode(" - ", request('responsible'))[0];
        }

        $data['priority'] = ($data['gravity'] * $data['urgency'] * $data['tendency']);

        $ticket->update($data);

        return redirect()
            ->route('ticket.show', $ticket)
            ->with(['success' => 'Chamado editado com sucesso!']);
    }

    public function rules()
    {
        if(request('due'))$this->authorize('edit_ticket');

        return request()->validate([
            'title' => 'required',
            'description' => 'required',
            'gravity' => 'required|numeric|min:1|max:5',
            'urgency' => 'required|numeric|min:1|max:5',
            'tendency' => 'required|numeric|min:1|max:5',
            'status' => ['nullable', Rule::in(['to do', 'in progress', 'delayed', 'done'])],
            'due' => 'nullable|date'
        ]);
    }
}
