<?php declare(strict_types=1);

namespace App\Application\Enum;

use App\Http\Routes\Auth\LoginRoute;
use App\Http\Routes\MainRoute;

abstract class Routes
{
    private static function getMap()
    {
        return [
            '/'      => MainRoute::class,
            '/login' => LoginRoute::class,
        ];
    }

    /**
     * @param string $uri
     *
     * @return string|null
     */
    public static function getRouterClass(string $uri): ?string
    {
        return self::getMap()[$uri] ?? null;
    }
}
