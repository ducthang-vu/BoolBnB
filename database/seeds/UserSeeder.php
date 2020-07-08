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
        $dummyUser = new User();
        $dummyUser->surname = 'Caio';
        $dummyUser->name = 'Tizio';
        $dummyUser->email = 'prova@gmail.com';
        $dummyUser->password = bcrypt('prova');
        $dummyUser->date_of_birth = $faker->date($format = 'Y-m-d', $max = '-18 years');
        $dummyUser->save();

        for($i = 0; $i < 33; $i++) {
            $newUser = new User();
            $newUser->surname = $faker->lastName();
            $newUser->name = $faker->firstName();
            $newUser->email = $faker->email();
            $newUser->password = Hash::make('mypassword');
            $newUser->date_of_birth = $faker->date($format = 'Y-m-d', $max = '-18 years');
            $newUser->save();
        }
    }
}
