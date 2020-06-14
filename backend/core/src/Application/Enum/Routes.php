<?php declare(strict_types=1);

namespace App\Application\Enum;

use App\Http\Routes\Auth\LoginRoute;
use App\Http\Routes\Auth\LogoutRoute;
use App\Http\Routes\Auth\RegisterRoute;
use App\Http\Routes\Document\DocumentRoute;
use App\Http\Routes\Document\EditDocumentRoute;
use App\Http\Routes\Image\GrayImageRoute;
use App\Http\Routes\Image\ImageRoute;
use App\Http\Routes\MainRoute;

abstract class Routes
{
    private static function getMap()
    {
        return [
            '/'              => MainRoute::class,
            '/login'         => LoginRoute::class,
            '/register'      => RegisterRoute::class,
            '/logout'        => LogoutRoute::class,
            '/documents'     => DocumentRoute::class,
            '/images'        => ImageRoute::class,
            '/makeGrayImage' => GrayImageRoute::class,
            '/edit_document' => EditDocumentRoute::class,
        ];
    }

    public static function getAllowedPathsForNotAuthorized()
    {
        return [
            '/',
            '/login',
            '/register',
        ];
    }

    public static function getNotAllowedPathsForAuthorized()
    {
        return [
            '/login',
            '/register',
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
