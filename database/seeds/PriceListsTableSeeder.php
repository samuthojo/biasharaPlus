<?php

use Illuminate\Database\Seeder;

class PriceListsTableSeeder extends Seeder
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
        \App\PriceList::create([
          'name' => $faker->word(1),
          'color' => $faker->hexcolor,
          'effective_date' => $faker->date,
        ]);
      }
    }
}
