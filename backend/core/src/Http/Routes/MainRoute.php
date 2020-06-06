<?php declare(strict_types=1);

namespace App\Http\Routes;

use App\Application\Enum\RequestMethods;
use App\Application\Routing\Controller\ControllerInterface;
use App\Application\Routing\RouterInterface;
use App\Http\Controller\MainController;

class MainRoute implements RouterInterface
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/';
    }

    /**
     * @return string[]
     * @see RequestMethods
     */
    public function allowedRequestMethods(): array
    {
        return [RequestMethods::GET];
    }

    /**
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface
    {
        return new MainController();
    }

    /**
     * @return RouterInterface
     */
    public static function make(): RouterInterface
    {
        return new self();
    }
}
