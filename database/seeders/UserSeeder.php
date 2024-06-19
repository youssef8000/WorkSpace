<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Predefined emails and types
        $users = [
            ['email' => 'free1@com.com', 'type' => 'freelancer'],
            ['email' => 'free2@com.com', 'type' => 'freelancer'],
            ['email' => 'free3@com.com', 'type' => 'freelancer'],
            ['email' => 'free4@com.com', 'type' => 'freelancer'],
            ['email' => 'free5@com.com', 'type' => 'freelancer'],
            ['email' => 'yoka@com.com', 'type' => 'client'],
            ['email' => 'jamr@com.com', 'type' => 'client'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $faker->name,
                'username' => $faker->username,
                'email' => $user['email'],
                'phone' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['male', 'female']),
                'portfolio' => $faker->url,
                'skills' => implode(', ', $faker->words(5)),
                'type' => $user['type'],
                'password' => Hash::make('11111111'),
            ]);
        }
    }
}
