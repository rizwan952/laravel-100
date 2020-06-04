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
        App\User::create([

        	'name' =>'rizwan',
        	'email'=>'rizwanafzal952@gmail.com',
        	'password'=>bcrypt(12345678),
        	'role' => 'admin'

        	]);

        App\User::create([

        	'name' =>'Ahmad',
        	'email'=>'ahmad@gmail.com',
        	'password'=>bcrypt(12345678),
        	'role' => 'editor'

        	]);

        App\User::create([

        	'name' =>'Moeen',
        	'email'=>'moeen@gmail.com',
        	'password'=>bcrypt(12345678),
        	'role' => 'subscriber'

        	]);
    }
}
