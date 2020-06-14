<?php declare(strict_types=1);

namespace App\Http\Controller\Error;

use App\Application\Request\Request;
use App\Application\Response\Response;
use App\Application\Routing\Controller\AbstractController;
use App\Application\Routing\Controller\ControllerInterface;

class ErrorController extends AbstractController implements ControllerInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getResponse(Request $request): Response
    {
        return $this->badRequest('Ошибка');
    }
}
