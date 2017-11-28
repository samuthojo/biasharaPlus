<?php

namespace App\Listeners;

use App\Events\VersionCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeactivateOldVersions
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
     * @param  VersionCreated  $event
     * @return void
     */
    public function handle(VersionCreated $event)
    {
        \App\Version::where('status', true)
                    ->update(['status' => false,]);

        $version = $event->version;
        $version->status = true;
        $version->save();

        return false;
    }
}
