<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FormService;


class FormServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FormService::class);
    }
}
