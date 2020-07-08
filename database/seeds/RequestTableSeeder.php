<?php

use Illuminate\Database\Seeder;
use App\Flat;
use App\Request;
use Faker\Generator as Faker;

class RequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 100; $i++) { 
            $nweRequest = new Request();

            $nweRequest->flat_id = Flat::all()->random()->id;

            $nweRequest->message =  $faker->paragraph(3 , true);
            $nweRequest->email = $faker->email();
            $nweRequest->nome = $faker->firstName();
            $nweRequest->cognome = $faker->lastName();

            $nweRequest->save();
        }
    }
}
