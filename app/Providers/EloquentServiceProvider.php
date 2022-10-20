<?php


namespace App\Providers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function (?string $attribute, ?string $searchTerm){
            return $this->where($attribute, 'LIKE', "%{$searchTerm}%");
        });

        Builder::macro('orWhereLike', function (string $attribute, string $searchTerm){
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });
    }

}