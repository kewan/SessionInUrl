# Laraval Session Id In Url

third party cookies are blocked in iframes in safari.

All urls generated using laravels URL functions will have
the session id appended to the urls. 

Sessions will be validated on server side making sure ip and user agent have not changed.

### Usage

1. `composer require kewan/session-in-url`
1. In your `config/app.php` in the providers array, replace
`Illuminate\Session\SessionServiceProvider:class` with `Kewan\SessionInUrl\Providers\SessionServiceProvider::class`
1. Add `Kewan\SessionInUrl\Providers\RoutingServiceProvider::class` to providers array.