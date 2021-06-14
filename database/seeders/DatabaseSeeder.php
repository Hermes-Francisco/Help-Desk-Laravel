<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin'
        ]);

        $roleUser = Role::create([
            'name' => 'user'
        ]);

        $ability = Ability::create([
            'name' => 'create_ticket'
        ]);

        $roleUser->abilities()->save($ability);
    }
}
