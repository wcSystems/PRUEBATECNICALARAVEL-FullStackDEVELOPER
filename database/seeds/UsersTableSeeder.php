<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Aca creamos el usuario principal */

        DB::table('users')->insert([
            'name' => "Devs Only",
            'email' => 'test@devs-only.com',
            'password' => bcrypt('12345678'),
            'celular' => '12345678',
            'cedula' => '12345678',
            'nacimiento' => '1996-09-13',
        ]); 
    }
}
