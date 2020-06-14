<?php declare(strict_types=1);

namespace App\Http\Controller\Images;

use App\Application\Enum\RequestMethods;
use App\Application\Request\Request;
use App\Application\Request\SuccessResponse;
use App\Application\Response\Response;
use App\Application\Routing\Controller\AbstractController;
use App\Application\Routing\Controller\ControllerInterface;
use App\Auth\AuthService;
use App\Document\DocumentService;
use App\Image\ImageService;

class GrayImagesController extends AbstractController implements ControllerInterface
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getResponse(Request $request): Response
    {
        if ($request->getMethod() === RequestMethods::GET) {
            $this->handleGetRequest();
        }
    }

    private function handleGetRequest()
    {
        $this->imageService->makeImageGray($_GET['id'], $_GET['type']);

        $this->redirect('/images');
    }
}
