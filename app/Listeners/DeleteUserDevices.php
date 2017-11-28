<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteUserDevices
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
     * @param  UserDeleted  $event
     * @return bool
     */
    public function handle(UserDeleted $event)
    {
        $event->user->devices()->delete();
        return false;
    }
}
