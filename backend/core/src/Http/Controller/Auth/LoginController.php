<?php declare(strict_types=1);

namespace App\Http\Controller\Auth;

use App\Application\Enum\RequestMethods;
use App\Application\Request\Request;
use App\Application\Response\Response;
use App\Application\Routing\Controller\AbstractController;
use App\Application\Routing\Controller\ControllerInterface;

class LoginController extends AbstractController implements ControllerInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getResponse(Request $request): Response
    {
        if ($request->getMethod() === RequestMethods::GET) {
            return $this->handleGetRequest($request);
        }
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    private function handleGetRequest(Request $request): Response
    {
        return $this->render('auth/login', $request);
    }
}
