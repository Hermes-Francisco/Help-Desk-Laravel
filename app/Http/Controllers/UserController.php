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
        if($user->is(request()->user()))
            return redirect(route('profile.show'));

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(User $user)
    {
        if($user->is(request()->user()))
            return redirect(route('profile.show'));

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

        return redirect(route('users.index'))
            ->with('success', 'Os dados de '.$input['name'].' foram atualizados');
    }

    public function recover(User $user)
    {
        $token = app(PasswordBroker::class)->createToken($user);

        Notification::send($user, new PasswordRecovery($token));

        return back()->with('status', 'Email de recuperação enviado com sucesso');
    }

    public function forgot()
    {
        $input = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
        ]);

        $user = User::where('email', $input['email'])->first();

        $token = app(PasswordBroker::class)->createToken($user);

        Notification::send($user, new PasswordRecovery($token));

        return back()->with('status', 'Email de recuperação enviado com sucesso');
    }

    public function delete(User $user)
    {
        $user->destroy($user->id);

        return redirect(route('users.index'))
            ->with('success', 'A conta de '.$user->name.' foi deletada com sucesso');
    }
}
