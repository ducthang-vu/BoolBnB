<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 50; $i++) {
            $newUser = new User();
            $newUser->surname = $faker->lastName();
            $newUser->name = $faker->firstName();
            $newUser->email = 'prova' . ($i + 1) . '@gmail.com';
            $newUser->password = bcrypt('prova');
            $newUser->date_of_birth = $faker->date($format = 'Y-m-d', $max = '-18 years');
            $newUser->save();
        }
    }
}
