<?php

namespace App\Providers;

use App\Business\Interfaces\MessageServiceInterface;
// use App\Business\Services\HiService;
use Illuminate\Support\ServiceProvider;
use App\Business\Services\HiUserService;
use App\Business\Services\EncryptService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MessageServiceInterface::class, HiUserService::class);

        $this->app->bind(EncryptService::class, function () {
            return new EncryptService(env('KEY_ENCRYPT'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
