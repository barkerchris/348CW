<?php

use Illuminate\Database\Seeder;

class ProfilePictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProfilePicture::class, 50)->create();
    }
}
