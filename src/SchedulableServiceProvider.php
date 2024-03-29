<?php

namespace SouhailMerroun\Schedulable;

use Illuminate\Support\ServiceProvider;

class SchedulableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
			realpath(__DIR__.'/../migrations') => database_path('migrations')
		], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
