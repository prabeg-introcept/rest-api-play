<?php

namespace App\Listeners;

use App\Events\WorklogCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWorklogCreatedNotification
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
     * @param  \App\Events\WorklogCreated  $event
     * @return void
     */
    public function handle(WorklogCreated $event)
    {
        //
    }
}
