<?php

namespace App\Listeners;

use App\Events\VersionCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Notifications;

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
     * Notify users of the new version, deactivate old versions
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

        //Notify the users of the new version
        $notificationsController = new Notifications();
        $notificationsController->updateApplication($version);

        return false;
    }

}
