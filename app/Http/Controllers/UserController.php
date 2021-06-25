<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\PasswordRecovery;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::orderBy('role_id')
                ->orderBy('name')
                ->paginate(10)
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(User $user)
    {
        $input = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['exists:roles,id', 'required']
        ]);

        $user->update(
            [
                'email' => $input['email'],
                'name' => $input['name'],
                'role_id' => $input['role']
            ]
        );

        return back()->with('status', 'Os dados do usuário foram atualizados');
    }

    public function recover(User $user)
    {
        $token = app(PasswordBroker::class)->createToken($user);

        Notification::send($user, new PasswordRecovery($token));

        return back()->with('status', 'Email de recuperação enviado com sucesso');
    }
}
