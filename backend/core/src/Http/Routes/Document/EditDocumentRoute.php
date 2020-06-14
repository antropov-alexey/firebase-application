<?php declare(strict_types=1);

namespace App\Http\Routes\Document;

use App\App;
use App\Application\Enum\RequestMethods;
use App\Application\Routing\Controller\ControllerInterface;
use App\Application\Routing\RouterInterface;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\Document\DocumentController;
use App\Http\Controller\Document\EditDocumentController;

class EditDocumentRoute implements RouterInterface
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/document_edit';
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
        return new EditDocumentController(App::DocumentService());
    }

    /**
     * @return RouterInterface
     */
    public static function make(): RouterInterface
    {
        return new self();
    }
}
