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

        $user = Role::create([
            'name' => 'user'
        ]);

        $manager = Role::create([
            'name' => 'manager'
        ]);

        $support = Role::create([
            'name' => 'support'
        ]);

        $editTicket = Ability::create([
            'name' => 'edit_ticket'
        ]);

        $editResponsability = Ability::create([
            'name' => 'edit_responsability'
        ]);

        $createAction = Ability::create([
            'name' => 'create_action'
        ]);

        //editTicket
        $support->abilities()->save($editTicket);
        $manager->abilities()->save($editTicket);

        //editResponsability
        $manager->abilities()->save($editResponsability);

        //createAction
        $support->abilities()->save($createAction);
        $manager->abilities()->save($createAction);
        $admin->abilities()->save($createAction);
    }
}
