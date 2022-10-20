<?php


namespace App\Providers;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeDirectivesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', fn () => auth()->check() && auth()->user()->isAdmin() ?? false);

        Blade::if('vendor', fn () => (auth()->check() && auth()->user()->isVendor()) ?? false);

        Blade::if('user', fn () => (auth()->check() && auth()->user()->isUser()) ?? false);
    }

}