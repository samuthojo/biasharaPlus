<?php

namespace App\Listeners;

use App\Events\PriceListDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletePriceListPrices
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PriceListDeleted  $event
     * @return bool
     */
    public function handle(PriceListDeleted $event)
    {
      $event->priceList->prices()->delete();
      return false;
    }
}
