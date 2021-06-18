<?php

namespace App\View\Components;

use App\Models\Ability;
use Illuminate\View\Component;

class UserDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-dropdown', [
            'users' => Ability::where('name', 'create_action')
                        ->first()
                        ->roles->map->users->flatten()
        ]);
    }
}
