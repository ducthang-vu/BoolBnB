<?php

use Illuminate\Database\Seeder;
use App\Flat;
use App\Service;
use Faker\Generator as Faker;

class FlatServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (Flat::all() as $flat) {
            $serviceIds = [];
            foreach (Service::all() as $service) {
                $faker->boolean(30) && $serviceIds[] = $service->id;
            }
            $flat->services()->attach($serviceIds);
        }
    }
}
