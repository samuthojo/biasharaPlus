<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();
      //
      // for ($i=1; $i < 4; $i++) {
      //     $user = [
      //         'username' => $faker->firstName,
      //         'email' => $faker->email,
      //         'phone_number' => $faker->phoneNumber,
      //         'image_url' => 'uploads/users/1.jpg',
      //         'subscription' => ($i % 2 == 0) ? 'free' : 'premium',
      //         'subscription_start_date' => $faker->date,
      //         'subscription_end_date' => $faker->date,
      //         'total_cc' => $faker->numberBetween(1, 100),
      //         'business_id' => $faker->creditCardNumber,
      //         'country' => $faker->country,
      //     ];
      //     \App\User::create($user);
      // }
      \App\User::create([
        'username' => env('ADMIN_USERNAME'),
        'password' => Hash::make(env('ADMIN_PASSWORD')),
        'is_admin' => true,
      ]);
      \App\User::create([
        'username' => env('IPF_PAY_USERNAME'),
        'password' => Hash::make(env('IPF_PAY_PASSWORD')),
        'is_admin' => true,
        'is_system' => true,
      ]);

    }
}
