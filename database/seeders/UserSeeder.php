<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an instance of Faker
        $faker = Faker::create();

        // Create 10 users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName, // Ensure username is populated
                'password' => Hash::make('password'), // default password for all users
                'bio' => $faker->sentence,
                'website' => $faker->url,
                'profile_photo_path' => null, // or you can add a profile photo path if desired
            ]);
        }
    }
}
