<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\PriceListDeleted' => [
          'App\Listeners\DeletePriceListPrices',
        ],
        'App\Events\ProductDeleted' => [
          'App\Listeners\DeleteProductPrices',
        ],
        'App\Events\CategoryDeleted' => [
          'App\Listeners\DeleteCategoryProducts',
        ],
        'App\Events\UserDeleted' => [
          'App\Listeners\DeleteUserDevices',
        ],
        'App\Events\VersionCreated' => [
          'App\Listeners\DeactivateOldVersions',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
