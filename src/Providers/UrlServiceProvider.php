<?php

namespace Kewan\SessionInUrl\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UrlGenerator::class, \Kewan\SessionInUrl\Routing\UrlGenerator::class);
    }
}