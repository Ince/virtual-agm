<?php

namespace Ince\VAGM;

use Illuminate\Support\ServiceProvider;

class VagmApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/vagm.php' => config_path('vagm.php'),
        ], 'config');
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        //
    }
}
