<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Models\User;
use App\Policies\DeleteThemself;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Ticket::class => TicketPolicy::class,
        User::class => DeleteThemself::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user, $ability){
            if($ability === 'create_admin'){
                if(User::count() === 0)return true;
            }

            if($user && $ability != 'deleteThemself'){
                if($user->isAdmin() || $user->abilities()->contains($ability))
                return true;
            }
        });
    }
}
