<?php

namespace App\Listeners;

use App\Events\CategoryDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteCategoryProducts
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
     * @param  CategoryDeleted  $event
     * @return bool
     */
    public function handle(CategoryDeleted $event)
    {
        $event->category->products()->delete();
        return false;
    }
}
