<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        if ($this->app->isLocal())
            Mail::alwaysTo(env('EMAIL_TO_FROM_LOCAL'));

//        Model::preventLazyLoading($this->app->isLocal());
//        if (appInProduction() || appInStaging())
//            config(['app.timezone' => 'Australia/Sydney']);

        if (!request()->isJson()) {

            // It is also important to point out that Laravel 8 still includes pagination views built
            // using Bootstrap CSS. To use these views instead of the default Tailwind views
            Paginator::useBootstrap();
        }

        config(['pagination.perPage' => request('perPage') ?? PAGINATION_LENGTH]);
    }
}
