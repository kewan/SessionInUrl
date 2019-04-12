<?php

namespace Kewan\SessionInUrl\Providers;

use Illuminate\Support\ServiceProvider;
use Kewan\SessionInUrl\Routing\RouteUrlGenerator;

class UrlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(\Illuminate\Routing\RouteUrlGenerator::class, RouteUrlGenerator::class);
    }
}