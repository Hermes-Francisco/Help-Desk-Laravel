<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\Invite;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class InvitationController extends Controller
{
    public function create()
    {
        return view('auth.invite', [
            'roles' => Role::all()
        ]);
    }

    public function store()
    {
        $input = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['exists:roles,id', 'required']
        ]);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make(now()->timestamp),
        ]);

        $user->roles()->sync($input['role'], false);

        $token = app(PasswordBroker::class)->createToken($user);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now()
          ]);

        Notification::send($user, new Invite($token, $user));

        return back();
    }
}
