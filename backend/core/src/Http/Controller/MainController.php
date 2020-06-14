<?php declare(strict_types=1);

namespace App\Http\Controller;

use App\Application\Request\Request;
use App\Application\Response\Response;
use App\Application\Routing\Controller\AbstractController;
use App\Application\Routing\Controller\ControllerInterface;
use App\Auth\AuthService;
use App\Exception\FirebaseApiException;

class MainController extends AbstractController implements ControllerInterface
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
     * @throws FirebaseApiException
     */
    public function getResponse(Request $request): Response
    {
        $user = $this->authService->getAuthorizedUser();

        $template = $user !== null ? 'main-authorized' : 'main';

        return $this->render($template, ['user' => $user]);
    }
}
