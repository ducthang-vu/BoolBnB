<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Flat;
use App\Sponsorship;
use Faker\Generator as Faker;

class FlatSponsorshipSeeder extends Seeder
{
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run(Faker $faker)
     {
         foreach (Flat::all() as $flat) {
             foreach (Sponsorship::all() as $sponsorship) {
                 if ($faker->boolean(16)) {
                     $sponsorshipId = $sponsorship->id;
                 } else {
                     continue;
                 }
                 if ($faker->boolean()) {
                     $start = $faker->dateTimeBetween('-20 hours');
                 } else {
                     $start = $faker->dateTimeBetween('-3 months', '-2 months');
                 }
                 $end = clone $start;
                 $end->add(new DateInterval( 'PT' . $sponsorship->getHoursDurationAsStr() . 'H'));
                 $flat->sponsorships()->attach($sponsorshipId, [
                                                                'start' => $start,
                                                                'end' => $end,
                                                                'braintree_code' => 'fakePayment'
                 ]);
                 break;
             }
         }
     }
}
