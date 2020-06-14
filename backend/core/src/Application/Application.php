<?php declare(strict_types=1);

namespace App\Application;

use App\Application\Request\Request;
use App\Application\Routing\RoutingFactory;
use App\Http\Middleware\CheckAuthorizeMiddleware;
use App\Http\Middleware\CheckJWTTokensMiddleware;
use App\Http\Middleware\MiddlewareInterface;

class Application
{
    private RoutingFactory $routingFactory;

    /**
     * @param RoutingFactory $routingFactory
     */
    public function __construct(RoutingFactory $routingFactory)
    {
        $this->routingFactory = $routingFactory;
    }

    public function processRequest(): void
    {
        $request = new Request();

        $router = $this->routingFactory->getRouter($request);

        /** @var MiddlewareInterface $middleware */
        foreach ($this->getMiddleWares() as $middleware) {
            $middleware->process($request, $router);
        }

        $response = $router->getController()->getResponse($request);

        echo $response->getContent();
    }

    /**
     * @return MiddlewareInterface[]
     */
    private function getMiddleWares(): array
    {
        return [
            CheckAuthorizeMiddleware::make(),
            CheckJWTTokensMiddleware::make(),
        ];
    }
}
