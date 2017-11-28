<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(PriceListsTableSeeder::class);
        $this->call(PricesTableSeeder::class);
        $this->call(VersionsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(BundlesTableSeeder::class);
        $this->call(PayBillNumbersTableSeeder::class);
        $this->call(FeedbackTableSeeder::class);
    }
}
