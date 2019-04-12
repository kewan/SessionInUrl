<?php


namespace Kewan\SessionInUrl\Routing;

use Illuminate\Support\Facades\Config;

class RouteUrlGenerator extends \Illuminate\Routing\RouteUrlGenerator
{
    protected function getRouteQueryString(array $parameters)
    {
        if(!array_key_exists(Config::get('session.cookie'), $parameters)) {
            $parameters[Config::get('session.cookie')] = $this->request->session()->getId();
        }

        return parent::getRouteQueryString($parameters);
    }
}