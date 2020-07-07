<?php

use Illuminate\Database\Seeder;
use App\Flat;
use App\User;
use Faker\Generator as Faker;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            $new_flat = new Flat();
            $new_flat->user_id = User::all()->random()->id;
            $new_flat->title = $faker->text(50);
            $new_flat->description = $faker->text(500);
            $new_flat->number_of_rooms = $faker->randomNumber(1);
            $new_flat->number_of_beds = $new_flat->number_of_rooms * 2;
            $new_flat->number_of_bathrooms = rand(1, 3);
            $new_flat->square_meters = rand(25, 200);
            $new_flat->address = ;
            $new_flat->image;
            $new_flat->geolocation;
        }
    }
}
