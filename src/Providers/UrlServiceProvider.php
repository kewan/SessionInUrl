<?php

namespace Kewan\SessionInUrl\Providers;

use Illuminate\Support\ServiceProvider;
use Kewan\SessionInUrl\Routing\UrlGenerator;

class UrlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(\Illuminate\Routing\UrlGenerator::class, UrlGenerator::class);
    }
}