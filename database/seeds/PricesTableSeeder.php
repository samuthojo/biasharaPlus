<?php

use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      for($i = 1; $i < 4; $i++) {
        \App\Price::create([
          'product_id' => $i,
          'price_list_id' => $i,
          'price' => $faker->numberBetween(1000, 20000),
          'tanzania' => $faker->numberBetween(1000, 20000),
          'kenya' => $faker->numberBetween(1000, 20000),
          'uganda' => $faker->numberBetween(1000, 20000),
        ]);
      }
    }
}
