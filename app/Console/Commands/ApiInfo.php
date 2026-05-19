<?php

namespace App\Console\Commands;

use App\ExternalServices\ApiService;
use Illuminate\Console\Command;
use Override;

class ApiInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:api-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consulta el API Tercera';

    public function __construct(protected ApiService $apiService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jsonString = json_encode($this->apiService->getData());
        $this->info($jsonString);
    }
}
