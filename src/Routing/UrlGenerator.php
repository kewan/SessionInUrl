<?php

namespace Kewan\SessionInUrl\Routing;

class UrlGenerator extends \Illuminate\Routing\UrlGenerator
{
    public function to($path, $extra = [], $secure = null)
    {
        return $this->appendSid(parent::to($path, $extra, $secure));
    }

    protected function toRoute($route, $parameters, $absolute)
    {
        return $this->appendSid(parent::toRoute($route, $parameters, $absolute));
    }

    protected function appendSid($url)
    {
        if (!$this->request->hasSession()) {
            return $url;
        }

        $session = $this->request->session();

        // already in session?
        if (strpos($url, $session->getName()) !== false) {
            return $url;
        }

        $separator = (strpos($url, '?') !== false) ? '&' : '?';

        $url .= $separator . $session->getName() . '=' . $session->getId();

        return $url;
    }
}