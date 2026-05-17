<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LoginUserRegistered implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 3;
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
    public function handle(UserRegistered $event): void
    {
        throw new Exception("Ocurrio un error al registrar al usuario: {$this->attempts()}");
        // $this->release(5);
        // Log::info('UserRegistered', ['id' => $event->user->id]);
    }

    public function failed(UserRegistered $event, $exception)
    {
        Log::critical("El registro en el log del usuario {$event->user['id']} finalmente falló");
    }
}
