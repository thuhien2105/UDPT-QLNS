<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\RabbitMQConnection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RabbitMQConnection::class, function ($app) {
            return new RabbitMQConnection();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}