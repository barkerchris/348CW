<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = App\Role::where('title', 'Admin')->first();
        $lecturerRole = App\Role::where('title', 'Lecturer')->first();
        $studentRole = App\Role::where('title', 'Student')->first();

        $admin = App\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminadmin')
        ]);
        $admin->roles()->attach($adminRole);
        $admin->profilePicture()->save(App\ProfilePicture::create(['user_id' => $admin->id]));

        $lecturer = App\User::create([
            'name' => 'Lecturer',
            'email' => 'lecturer@lecturer.com',
            'password' => bcrypt('lecturerlecturer')
        ]);
        $lecturer->roles()->attach($lecturerRole);
        $lecturer->profilePicture()->save(App\ProfilePicture::create(['user_id' => $lecturer->id]));

        $helper = App\User::create([
            'name' => 'Helper',
            'email' => 'helper@helper.com',
            'password' => bcrypt('helperhelper')
        ]);
        $helper->roles()->attach($lecturerRole);
        $helper->roles()->attach($studentRole);
        $helper->profilePicture()->save(App\ProfilePicture::create(['user_id' => $helper->id]));

        $student = App\User::create([
            'name' => 'Student',
            'email' => 'student@student.com',
            'password' => bcrypt('studentstudent')
        ]);
        $student->roles()->attach($studentRole);
        $student->profilePicture()->save(App\ProfilePicture::create(['user_id' => $student->id]));
    }
}
