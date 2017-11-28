<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $countries = ["Tanzania", "Kenya", "Uganda", ];
      $short_forms = ["TZS", "KES", "UGS", ];
      $identification_numbers = [0, 1, 2, ];
      $index = 0;
      foreach($countries as $country) {
        \App\Country::create([
          'name' => $country,
          'short_form' => $short_forms[$index],
          'identification_number' => $identification_numbers[$index],
        ]);
        $index++;
      }
    }
}
