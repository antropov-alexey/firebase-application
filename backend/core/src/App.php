<?php declare(strict_types=1);

namespace App;

use App\Application\Application;
use App\Application\Routing\RoutingFactory;

class App
{
    public static function Application()
    {
        return new Application(new RoutingFactory());
    }
}
