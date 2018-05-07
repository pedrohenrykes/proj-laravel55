<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@email.com',
            'password' => bcrypt('admin')
        ]);
        User::create([
            'name'     => 'Pedro Henrique',
            'email'    => 'pedrohenrykes@gmail.com',
            'password' => bcrypt('pedro')
        ]);
    }
}
