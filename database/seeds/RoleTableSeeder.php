<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role;
        $role1->title = "Admin";
        $role1->save();

        $role2 = new Role;
        $role2->title = "Lecturer";
        $role2->save();

        $role3 = new Role;
        $role3->title = "Student";
        $role3->save();
    }
}
