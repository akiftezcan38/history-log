<?php

namespace Aurora\HistoryLog;

use Illuminate\Support\Facades\ServiceProvider;


class HistoryLogServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    }
}