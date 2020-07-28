<?php

use Illuminate\Database\Seeder;
use App\Flat;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        $TurinLat = 45.0677;
        $TurnLng = 7.6824;
        $LngPerKm = 0.013;

        for ($i = 0; $i < 100; $i++) {
            $new_flat = new Flat();
            $new_flat->user_id = User::all()->random()->id;
            $new_flat->title = $faker->text(50);
            $new_flat->description = $faker->text(500);
            $new_flat->number_of_rooms = rand(1, 5);
            $new_flat->number_of_beds = $new_flat->number_of_rooms * 2;
            $new_flat->number_of_bathrooms = rand(1, 3);
            $new_flat->square_meters = rand(25, 255);
            $new_flat->address = $faker->unique()->address();
            $new_flat->image = sprintf('images_seeding/city%d.jpg', $i % 48);
            $new_flat->created_at = new DateTime("2019-06-15");

            // geolocalization
            if ($i < 50 ) {
                $new_flat->lat = $TurinLat;
                $new_flat->lng = $TurnLng  + $i * $LngPerKm;
                // $new_flat->geolocation = DB::raw("(GeomFromText('POINT(45.0677 " . $lng . ")'))");
            } else {
                $new_flat->lat = $faker->randomFloat(4, $TurinLat - 5 * $LngPerKm, $TurinLat + 5 *  $LngPerKm);
                $new_flat->lng = $faker->randomFloat(4, $TurnLng - 5 * $LngPerKm, $TurnLng + 5 * $LngPerKm);
            }


            $new_flat->save();
        }
    }
}
