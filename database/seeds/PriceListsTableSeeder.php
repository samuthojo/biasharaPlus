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
      $names = ['asst_spvsr', 'spvsr', 'asst_man', 'man',
                'retail', 'novus'];
      // $faker = Faker\Factory::create();
      // foreach($names as $my_name) {
      //   \App\PriceList::create([
      //     'name' => $my_name,
      //     'color' => $faker->hexcolor,
      //     'effective_date' => $faker->date,
      //   ]);
      // }
    }
}
