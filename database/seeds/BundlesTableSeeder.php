<?php

use Illuminate\Database\Seeder;

class BundlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bundles = ["Package_1", "Package_2", "Package_3", ];
        $prices = [1000, 5000, 10000, ];
        //duration in months
        $durations = [1, 6, 12, ];
        $index = 0;
        foreach ($bundles  as $bundle) {
          \App\Bundle::create([
            'name' => $bundle,
            'price' => $prices[$index],
            'duration_in_months' => $durations[$index],
          ]);
          $index++;
        }
    }
}
