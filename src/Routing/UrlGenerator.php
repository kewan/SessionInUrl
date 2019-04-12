<?php

namespace Kewan\SessionInUrl\Routing;

class UrlGenerator extends \Illuminate\Routing\UrlGenerator
{
    public function formatParameters($parameters)
    {
        $parameters = parent::formatParameters($parameters);

        $session = $this->request->session();
        
        if (!array_key_exists($session->getName(), $parameters)) {
            $parameters[$session->getName()] = $session->getId();
        }

        return $parameters;
    }
}