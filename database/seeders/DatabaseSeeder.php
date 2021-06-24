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
        $admin = Role::create([
            'name' => 'admin'
        ]);

        $manager = Role::create([
            'name' => 'manager'
        ]);

        $support = Role::create([
            'name' => 'support'
        ]);

        $user = Role::create([
            'name' => 'user'
        ]);

        $editTicket = Ability::create([
            'name' => 'edit_ticket'
        ]);

        $editResponsibility = Ability::create([
            'name' => 'edit_responsibility'
        ]);

        $createAction = Ability::create([
            'name' => 'create_action'
        ]);

        //editTicket
        $support->abilities()->save($editTicket);
        $manager->abilities()->save($editTicket);

        //editResponsibility
        $manager->abilities()->save($editResponsibility);

        //createAction
        $support->abilities()->save($createAction);
        $manager->abilities()->save($createAction);
        $admin->abilities()->save($createAction);
    }
}
