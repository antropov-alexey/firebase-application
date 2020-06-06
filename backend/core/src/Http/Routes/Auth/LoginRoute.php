<?php declare(strict_types=1);

namespace App\Http\Routes\Auth;

use App\Application\Enum\RequestMethods;
use App\Application\Routing\Controller\ControllerInterface;
use App\Application\Routing\RouterInterface;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\MainController;

class LoginRoute implements RouterInterface
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/login';
    }

    /**
     * @return string[]
     * @see RequestMethods
     */
    public function allowedRequestMethods(): array
    {
        return [RequestMethods::GET, RequestMethods::POST];
    }

    /**
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface
    {
        return new LoginController();
    }

    /**
     * @return RouterInterface
     */
    public static function make(): RouterInterface
    {
        return new self();
    }
}
