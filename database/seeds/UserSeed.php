<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create
         ([
                 'email'=>'patricioprp06@gmail.com',
                 'password'=>Hash::make('32460264')
         ]);
    }
}
