<?php

namespace App\Http\Controllers;

use App\ExternalServices\ApiService;
use Exception;

class ApiController extends Controller
{

    public function __construct(protected ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function get()
    {
        $data = $this->apiService->getData();
        return response()->json($data);
    }
}
