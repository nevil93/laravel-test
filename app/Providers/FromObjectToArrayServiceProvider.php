<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FromObjectToArrayService;
use Psy\Util\Str;

class FromObjectToArrayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FromObjectToArrayService::class, function () {
            return new FromObjectToArrayService();
        });
    }
}
