<?php declare(strict_types=1);

namespace App\Http\Middleware;

use App\Application\Request\Request;
use App\Application\Routing\RouterInterface;

interface MiddlewareInterface
{
    public function process(Request $request, RouterInterface $router);

    public static function make(): self;
}
