<?php

namespace App\Listeners\Updates;

use App\Events\UpdateFinished;
use Artisan;

class Version1211 extends Listener
{
    const ALIAS = 'core';

    const VERSION = '1.2.11';

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle(UpdateFinished $event)
    {
        // Check if should listen
        if (!$this->check($event)) {
            return;
        }

        // Update database
        Artisan::call('migrate', ['--force' => true]);
    }
}
