<?php declare(strict_types=1);

namespace App\Http\Middleware;

use App\App;
use App\Application\Enum\Routes;
use App\Application\Request\Request;
use App\Application\Routing\Controller\AbstractController;
use App\Application\Routing\RouterInterface;
use App\Application\Session\SessionKeys;
use App\Application\Session\SessionService;
use App\Auth\AuthService;

class CheckAuthorizeMiddleware implements MiddlewareInterface
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function process(Request $request, RouterInterface $router)
    {
        $authUser = $this->authService->getAuthorizedUser();

        $allowedPathsForNotAuthorized = Routes::getAllowedPathsForNotAuthorized();
        $notAllowedPathsForAuthorized = Routes::getNotAllowedPathsForAuthorized();

        if (
            ( ! in_array($request->getUri(), $allowedPathsForNotAuthorized, true) && ! $authUser) ||
            (in_array($request->getUri(), $notAllowedPathsForAuthorized, true) && $authUser)
        ) {
            /** @var AbstractController $controller */
            $controller = $router->getController();
            $controller->redirect('/');
        }
    }

    public static function make(): MiddlewareInterface
    {
        return new self(App::AuthService());
    }
}
