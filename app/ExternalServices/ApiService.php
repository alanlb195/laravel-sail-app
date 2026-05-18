<?php

namespace App\ExternalServices;


use Illuminate\Support\Facades\Http;

use Exception;
use App\ExternalServices\Events\DataGet;

class ApiService
{

    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getData()
    {
        $response = Http::withoutVerifying()->get($this->url);

        if ($response->failed()) {
            throw new Exception("Error al obtener datos");
        }

        event(new DataGet($response->json()));
        return $response->json();
    }
}
