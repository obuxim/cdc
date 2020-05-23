<?php

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
        // $this->call(UserSeeder::class);
        factory(App\User::class, 1)->create()->each(function ($user){
            $user->profile()->save(factory(App\Profile::class)->make());
        });
    }
}
