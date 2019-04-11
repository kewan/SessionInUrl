<?php


namespace Kewan\SessionInUrl\Providers;


use Illuminate\Session\Middleware\StartSession;

class SessionServiceProvider extends \Illuminate\Session\SessionServiceProvider
{
    public function register()
    {
        $this->registerSessionManager();
        $this->registerSessionDriver();

        $this->app->singleton(StartSession::class, \Kewan\SessionInUrl\Middleware\StartSession::class);
    }
}