<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Hi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hi
                            {name : Nombre de la persona}
                            {--lastName= : Apellido de la persona}
                            {--uppercase : Convierte el mensaje a mayúsculas}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra un saludo personalizado';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument("name");
        $lastName = $this->option("lastName");
        $uppercase = $this->option("uppercase");

        // dd($uppercase);
        $message = "Hola {$name} {$lastName}";

        if ($uppercase) {
            $message = strtoupper($message);
        }

        $this->info($message);
    }
}
