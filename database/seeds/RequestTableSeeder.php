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
        for ($i=0; $i < 4000; $i++) {
            $newRequest = new Request();

            $newRequest->flat_id = Flat::all()->random()->id;

            $newRequest->surname = $faker->lastName();
            $newRequest->name = $faker->firstName();
            $newRequest->email = $faker->email();
            $newRequest->message =  $faker->paragraph(3 , true);
            $newRequest->created_at = $faker->dateTimeThisYear('now');

            $newRequest->save();
        }
    }
}
