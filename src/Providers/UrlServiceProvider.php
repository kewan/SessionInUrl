<?php

namespace Kewan\SessionInUrl\Providers;

use Illuminate\Support\ServiceProvider;
use Kewan\SessionInUrl\Routing\UrlGenerator;

class UrlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(\Illuminate\Routing\UrlGenerator::class, UrlGenerator::class);

        $this->app->singleton('url', function ($app) {
            $routes = $app['router']->getRoutes();

            // The URL generator needs the route collection that exists on the router.
            // Keep in mind this is an object, so we're passing by references here
            // and all the registered routes will be available to the generator.
            $this->app->instance('routes', $routes);
            $url = new UrlGenerator($routes, $app->rebinding('request', function ($app, $request) {
                    $app['url']->setRequest($request);
                }));
            $url->setSessionResolver(function () {
                return $this->app['session'];
            });

            // If the route collection is "rebound", for example, when the routes stay
            // cached for the application, we will need to rebind the routes on the
            // URL generator instance so it has the latest version of the routes.
            $app->rebinding('routes', function ($app, $routes) {
                $app['url']->setRoutes($routes);
            });

            return $url;
        });
    }
}
}