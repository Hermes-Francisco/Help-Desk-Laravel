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

        if(request('responsible')){
            $this->authorize('edit_responsibility');
            $data['responsible_id'] = (int)explode(" - ", request('responsible'))[0];
        }

        $data['priority'] = ($data['gravity'] * $data['urgency'] * $data['tendency']);
        $data['status'] = 'to do';

        request()->user()->tickets()->create($data);

        return redirect(route('dashboard'));
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
    }

    public function rules()
    {
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
