<?php


namespace Kewan\SessionInUrl\Middleware;


use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class StartSession extends \Illuminate\Session\Middleware\StartSession
{
    const LOCKED_KEY = 'locked_to';

    public function getSession(Request $request)
    {
        $session = $this->manager->driver();
        $session->setId($request->input($session->getName()));
        $session->start();

        if (!$session->has(self::LOCKED_KEY)) {
            $this->lockToUser($session, $request);
        } else {
            // validate session against store IP and user agent hash
            if (!$this->isValid($session, $request)) {
                $session->setId(null); // refresh ID
                $session->start();
                $this->lockToUser($session, $request);
            }
        }
        return $session;
    }

    protected function lockToUser(Session $session, Request $request)
    {
        $session->put(self::LOCKED_KEY, $this->buildHash($request));
    }

    protected function isValid(Session $session, Request $request)
    {
        return $session->get(self::LOCKED_KEY) == $this->buildHash($request);
    }

    private function buildHash(Request $request)
    {
        return sha1(json_encode([
            'ip'    => $request->getClientIp(),
            'agent' => sha1($request->server('HTTP_USER_AGENT')),
        ]));

    }
}