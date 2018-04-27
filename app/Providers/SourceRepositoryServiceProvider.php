<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SourceRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
         'Repositories\Contracts\SourceRepositoryInterface',
         'Repositories\Eloquent\FixerRepository'
      );
    }
}
