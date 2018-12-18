<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Streamline;
use Psy\Util\Str;

class StreamlineServiceProvider extends ServiceProvider
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
        $this->app->singleton(Streamline::class, function () {
            return new Streamline();
        });
    }
}
