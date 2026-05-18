<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ExternalServices\ApiService;
use App\ExternalServices\Events\DataGet;
use App\ExternalServices\Listeners\LogDataGet;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ApiService::class, function ($app) {
            $url = config('services.api.url');
            return new ApiService($url);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::get("/api/posts", function (ApiService $apiService) {
            return response()->json($apiService->getData());
        });

        Event::listen(DataGet::class, LogDataGet::class);
    }
}
