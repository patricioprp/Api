<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FabricanteSeeder::class);
        $this->call(VehiculoSeeder::class);
        User::truncate();
        $this->call(UserSeed::class);
    }
}
