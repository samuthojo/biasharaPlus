<?php

namespace App\Listeners;

use App\Events\ProductDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteProductPrices
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
     * @param  ProductDeleted  $event
     * @return bool
     */
    public function handle(ProductDeleted $event)
    {
        $event->product->prices()->delete();
        return false;
    }
}
