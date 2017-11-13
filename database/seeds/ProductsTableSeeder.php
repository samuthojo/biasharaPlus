<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      for($i = 1; $i < 7; $i++) {
        \App\Product::create([
          'category_id' => $i,
          'name' => $faker->word(1),
          'code' => 'ABA',
          'cc' => $faker->numberBetween(1,5),
          'image' => '1.jpg',
          'description' => $faker->paragraph(3, true),
        ]);
      }
    }
}
