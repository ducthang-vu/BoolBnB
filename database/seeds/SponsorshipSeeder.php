<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                'type' => '24 ore',
                'price' => 2.99,
                'duration' => '24:00:00'
            ],
            [
                'type' => '72 ore',
                'price' => 5.99,
                'duration' => '72:00:00'
            ],
            [
                'type' => '144 ore',
                'price' => 9.99,
                'duration' => '144:00:00'
            ]
        ];

        foreach ($sponsorships as $sponsorship) {
            $new_sponsorship = new Sponsorship();
            $new_sponsorship->sponsor_type = $sponsorship['type'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->duration = $sponsorship['duration'];

            $new_sponsorship->save();
        };
    }
}
