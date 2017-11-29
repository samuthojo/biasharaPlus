<?php

use Illuminate\Database\Seeder;

class PayBillNumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $providers = ["Vodacom", "Tigo", "Airtel", ];
      $phone_numbers = ["0767188777", "0718728778", "0767188777", ];
      $index = 0;
      foreach ($providers  as $provider) {
        \App\PayBillNumber::create([
          'service_provider' => $provider,
          'phone_number' => $phone_numbers[$index],
        ]);
        $index++;
      }
    }
}
