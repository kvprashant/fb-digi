<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../node_modules/datamaps/dist/datamaps.world.min.js' => public_path('js/datamaps.world.min.js'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../../node_modules/d3/d3.min.js' => public_path('js/d3.min.js'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../../node_modules/randomcolor/randomColor.js' => public_path('js/randomColor.js'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../../resources/assets/countries.json' => public_path('countries.json'),
        ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
