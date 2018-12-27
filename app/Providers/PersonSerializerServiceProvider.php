<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PersonSerializerService;
use Psy\Util\Str;

class PersonSerializerServiceProvider extends ServiceProvider
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
        $this->app->singleton(PersonSerializerService::class, function () {
            return new PersonSerializerService();
        });
    }
}
