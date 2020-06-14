<?php declare(strict_types=1);

namespace App\Http\Controller\Auth;

use App\Application\Enum\RequestMethods;
use App\Application\Request\Request;
use App\Application\Request\SuccessResponse;
use App\Application\Response\Response;
use App\Application\Routing\Controller\AbstractController;
use App\Application\Routing\Controller\ControllerInterface;
use App\Auth\AuthService;
use App\Exception\ApiException;

class LogoutController extends AbstractController implements ControllerInterface
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getResponse(Request $request): Response
    {
        return $this->handlePostRequest();
    }

    /**
     * @return Response
     */
    private function handlePostRequest(): Response
    {
        $this->authService->logout();

        return $this->json(new SuccessResponse());
    }
}
