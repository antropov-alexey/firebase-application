<?php declare(strict_types=1);

namespace App\Http\Routes\Auth;

use App\App;
use App\Application\Enum\RequestMethods;
use App\Application\Routing\Controller\ControllerInterface;
use App\Application\Routing\RouterInterface;
use App\Http\Controller\Auth\LogoutController;
use App\Http\Controller\Auth\RegisterController;

class LogoutRoute implements RouterInterface
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/logout';
    }

    /**
     * @return string[]
     * @see RequestMethods
     */
    public function allowedRequestMethods(): array
    {
        return [RequestMethods::POST];
    }

    /**
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface
    {
        return new LogoutController(App::AuthService());
    }

    /**
     * @return RouterInterface
     */
    public static function make(): RouterInterface
    {
        return new self();
    }
}
