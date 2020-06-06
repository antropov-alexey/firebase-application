<?php declare(strict_types=1);

namespace App\Application\Routing;

use App\Application\Enum\Routes;
use App\Application\Request\Request;
use App\Http\Routes\Error\ErrorRoute;

class RoutingFactory
{
    /**
     * @param Request $request
     *
     * @return RouterInterface
     */
    public function getRouter(Request $request): RouterInterface
    {
        $routerClass = Routes::getRouterClass($request->getUri());

        if ( ! $routerClass) {
            $router = $this->getDefault();
        }
        else {
            try {
                /** @var RouterInterface $router */
                $router = $routerClass::make();
            }
            catch (\Throwable $exception) {
                $router = $this->getDefault();
            }
        }

        return $router;
    }

    /**
     * @return RouterInterface
     */
    private function getDefault(): RouterInterface
    {
        return new ErrorRoute();
    }
}
