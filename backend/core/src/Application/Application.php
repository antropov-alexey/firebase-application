<?php declare(strict_types=1);

namespace App\Application;

use App\Application\Request\Request;
use App\Application\Routing\RoutingFactory;

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

        $response = $router->getController()->getResponse($request);

        echo $response->getContent();
    }
}
