<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearAllUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:clear-all-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina la carpeta de archivos cargados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath = public_path('tempfiles');

        if (!File::exists($folderPath)) {
            $this->warn('Carpeta no encontrada');
            return Command::FAILURE;
        }

        $files = File::files($folderPath);

        foreach ($files as $file) {
            File::delete($file);
            $this->info("Eliminado: " . $file->getFilename());
        }

        $this->info('Se eliminaron todos los archivos de la carpeta: tempfiles');
        return Command::SUCCESS;
    }
}
