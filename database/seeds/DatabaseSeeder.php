<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\URL;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        if($this->app->environment('local')) {
            factory(User::class, 5)->create();
        }
        
    }
}
