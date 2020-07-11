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
            $new_flat->number_of_rooms = rand(1, 5);
            $new_flat->number_of_beds = $new_flat->number_of_rooms * 2;
            $new_flat->number_of_bathrooms = rand(1, 3);
            $new_flat->square_meters = rand(25, 255);
            $new_flat->address = $faker->address();
            $new_flat->image = $faker->imageUrl(400, 200);
            $new_flat->visualisations = rand(0, 1000);

            // geolocalization
            $lng = 7.6824 + $i * 0.013;
            $new_flat->lat = 45.0677;
            $new_flat->lng = $lng;
            // $new_flat->geolocation = DB::raw("(GeomFromText('POINT(45.0677 " . $lng . ")'))");

            $new_flat->save();
        }
    }
}
