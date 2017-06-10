<?php

namespace App\Listeners;

use App\Events\UserUpdates;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Updates
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
     * @param  UserUpdates  $event
     * @return void
     */
    public function handle(UserUpdates $event)
    {
        //
    }
}
