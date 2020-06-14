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

class ImagesController extends AbstractController implements ControllerInterface
{
    private ImageService $imageService;
    private AuthService  $authService;

    public function __construct(ImageService $imageService, AuthService $authService)
    {
        $this->imageService = $imageService;
        $this->authService  = $authService;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getResponse(Request $request): Response
    {
        if ($request->getMethod() === RequestMethods::GET) {
            return $this->handleGetRequest();
        }
        else {
            return $this->handlePostRequest();
        }
    }

    private function handleGetRequest()
    {
        $images = $this->imageService->getFiles();

        return $this->render('images', ['images' => $images]);
    }

    private function handlePostRequest()
    {
        $imageType   = $_FILES['image']['type'];
        $tmpFileName = $_FILES['image']['tmp_name'];

        $this->imageService->saveImage(
            $this->authService->getAuthorizedUser()->getUid(),
            $imageType,
            $tmpFileName
        );

        $this->redirect('/images');
    }
}
