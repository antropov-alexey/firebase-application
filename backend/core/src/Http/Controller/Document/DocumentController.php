<?php declare(strict_types=1);

namespace App\Http\Controller\Document;

use App\Application\Enum\RequestMethods;
use App\Application\Request\Request;
use App\Application\Request\SuccessResponse;
use App\Application\Response\Response;
use App\Application\Routing\Controller\AbstractController;
use App\Application\Routing\Controller\ControllerInterface;
use App\Document\DocumentService;

class DocumentController extends AbstractController implements ControllerInterface
{
    private DocumentService $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
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
        $documents = $this->documentService->getAll();

        return $this->render('document', ['documents' => $documents]);
    }

    private function handlePostRequest()
    {
        $this->documentService->save($_POST['title'], $_POST['content']);

        $this->redirect('/documents');
    }
}
