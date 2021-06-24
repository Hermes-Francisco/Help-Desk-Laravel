<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeleteThemself
{
    use HandlesAuthorization;

    public function deleteThemself(User $user, User $model)
    {
        if($user->is($model))
        {
            if($user->isAdmin())return User::where('role_id', 1)->count() > 1;
            return true;
        }
        elseif($user->isAdmin())return true;
    }
}
