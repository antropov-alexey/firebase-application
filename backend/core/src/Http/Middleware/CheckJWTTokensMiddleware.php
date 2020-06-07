<?php declare(strict_types=1);

namespace App\Http\Middleware;

use App\App;
use App\Application\Cookie\CookieKeys;
use App\Application\Cookie\CookieService;
use App\Application\Request\Request;
use App\Application\Routing\RouterInterface;
use App\Application\Session\SessionKeys;
use App\Application\Session\SessionService;
use App\Auth\AuthService;

class CheckJWTTokensMiddleware implements MiddlewareInterface
{
    private SessionService $sessionService;
    private CookieService  $cookieService;
    private AuthService    $authService;

    public function __construct(
        SessionService $sessionService,
        CookieService $cookieService,
        AuthService $authService
    )
    {
        $this->sessionService = $sessionService;
        $this->cookieService  = $cookieService;
        $this->authService    = $authService;
    }

    public function process(Request $request, RouterInterface $router)
    {
        if (
            $this->sessionService->get(SessionKeys::USER_ID) &&
            ( ! $this->cookieService->get(CookieKeys::ID_TOKEN) || ! $this->cookieService->get(CookieKeys::REFRESH_TOKEN))
        ) {
            $this->authService->logout();
        }
    }

    public static function make(): MiddlewareInterface
    {
        return new self(
            new SessionService(),
            new CookieService(),
            App::AuthService()
        );
    }
}
