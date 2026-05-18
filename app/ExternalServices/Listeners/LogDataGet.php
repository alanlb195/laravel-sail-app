<?php

namespace App\ExternalServices\Listeners;

use App\ExternalServices\Events\DataGet;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogDataGet
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DataGet $event): void
    {
        Log::info("Datos obtenidos desde el servicio externo: ", $event->data);
    }
}
