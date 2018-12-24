<?php

use Illuminate\Database\Seeder;
use App\Vehiculo;
use App\Fabricante;
use Faker\Factory as Faker;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $cantidad = Fabricante::all()->count();
        for($i=0;$i<$cantidad;$i++)
        {
         Vehiculo::create
         ([
                 'color'=>$faker->safeColorName(),
                 'cilindraje'=>$faker->randomFLoat(),
                 'potencia'=>$faker->randomNumber(7),
                 'peso'=>$faker->randomFloat(),
                 'fabricante_id'=>$faker->numberBetween(1,$cantidad)
         ]);
        }
    }
}
