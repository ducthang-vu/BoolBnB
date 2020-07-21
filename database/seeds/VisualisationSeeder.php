<?php

use App\Flat;
use App\Visualisation;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class VisualisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20000; $i++) {
            $newVisualisation = new Visualisation();
            $newVisualisation->flat_id = Flat::all()->random()->id;
            $newVisualisation->created_at = $faker->dateTimeThisYear('now');
            $newVisualisation->save();
        }
    }
}
