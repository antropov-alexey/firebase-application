<?php declare(strict_types=1);

namespace App\Http\Routes\Error;

use App\Application\Enum\RequestMethods;
use App\Application\Routing\Controller\ControllerInterface;
use App\Application\Routing\RouterInterface;
use App\Http\Controller\Error\ErrorController;

class ErrorRoute implements RouterInterface
{
    /**
     * @return string[]
     * @see RequestMethods
     */
    public function allowedRequestMethods(): array
    {
        return [RequestMethods::GET];
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/error';
    }

    /**
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface
    {
        return new ErrorController();
    }

    /**
     * @return RouterInterface
     */
    public static function make(): RouterInterface
    {
        return new ErrorRoute();
    }
}
