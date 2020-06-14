<?php declare(strict_types=1);

namespace App\Application\Routing;

use App\Application\Enum\RequestMethods;
use App\Application\Routing\Controller\ControllerInterface;

interface RouterInterface
{
    /**
     * @return string[]
     * @see RequestMethods
     */
    public function allowedRequestMethods(): array;

    /**
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface;

    /**
     * @return string
     */
    public function getPath(): string;

    public static function make(): self;
}
