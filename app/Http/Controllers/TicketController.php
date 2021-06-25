<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $role = $user->role->name;
        $query = request()->query();
        if($role == 'user'){
            if(! isset($query['author']) || request()->query('author') != $user->id)
                return redirect('/?author='.$user->id);
        }
        if($role == 'support'){
            if(! isset($query['todas']) && ! isset($query['responsible']) && ! isset($query['author']))
                return redirect('/?responsible='.$user->id);
        }

        if($role == 'manager' || $role == 'admin'){
            if(! isset($query['todas']) && ! isset($query['responsible']) && ! isset($query['author']))
                return redirect('/?responsible=none');
        }

        if(!isset($query['status'])){
            return redirect('/?status=to do&'.http_build_query(request()->except(['status', 'page'])));
        }

        return view('tickets.index', [
            'tickets' => Ticket::orderBy('priority', 'desc')
                ->orderBy('due')
                ->orderBy('created_at')
                ->filter(
                    request()->query()
                )
                ->paginate(10)
                ->withQueryString()
        ]);
    }

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

    private function rulesUser($query){

    }
}
