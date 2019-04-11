<?php


namespace Kewan\SessionInUrl\Routing;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class UrlGenerator extends \Illuminate\Routing\UrlGenerator
{
    public function to($path, $extra = [], $secure = null)
    {
        $url = parent::to($path, $extra, $secure);

        if (isset($extra['NO_SID'])) {
            unset($extra['NO_SID']);
            return $url;
        }

        return $this->appendSid($url);
    }

    private function appendSid($url)
    {

        if (strpos($url, Config::get('session.cookie')) !== false) {
            return $url;
        }

        $separator = (strpos($url, '?') !== false) ? '&' : '?';

        $url .= $separator . Config::get('session.cookie') . '=' . Session::getId();

        return $url;
    }
}