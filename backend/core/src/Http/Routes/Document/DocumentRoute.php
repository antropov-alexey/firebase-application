<?php declare(strict_types=1);

namespace App\Http\Routes\Document;

use App\App;
use App\Application\Enum\RequestMethods;
use App\Application\Routing\Controller\ControllerInterface;
use App\Application\Routing\RouterInterface;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\Document\DocumentController;

class DocumentRoute implements RouterInterface
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/documents';
    }

    /**
     * @return string[]
     * @see RequestMethods
     */
    public function allowedRequestMethods(): array
    {
        return [RequestMethods::GET, RequestMethods::POST];
    }

    /**
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface
    {
        return new DocumentController(App::DocumentService());
    }

    /**
     * @return RouterInterface
     */
    public static function make(): RouterInterface
    {
        return new self();
    }
}
