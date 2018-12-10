<?php

namespace App\Providers;

use App\Providers\addLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\Logger;

class addLogListener
{
    private $log;

    /**
     * addLogListener constructor.
     * @param Logger $log
     */
    public function __construct(Logger $log)
    {
        $this->log = $log;
    }

    /**
     * Handle the event.
     *
     * @param  addLogEvent  $event
     * @return void
     */
    public function handle(addLogEvent $event)
    {

        if (is_array($event->logMsg)) {
            $this->log->error('Error', $event->logMsg);
        } else {
            $this->log->info($event->logMsg);
        }
    }
}
