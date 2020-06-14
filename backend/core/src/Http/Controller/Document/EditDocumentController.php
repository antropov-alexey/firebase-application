<?php declare(strict_types=1);

namespace App\Http\Controller\Document;

use App\Application\Enum\RequestMethods;
use App\Application\Request\Request;
use App\Application\Response\Response;
use App\Application\Routing\Controller\AbstractController;
use App\Application\Routing\Controller\ControllerInterface;
use App\Document\Document;
use App\Document\DocumentService;
use Carbon\Carbon;

class EditDocumentController extends AbstractController implements ControllerInterface
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
        $uid = $_GET['uid'];

        $document = $this->documentService->getById($uid);

        if ( ! $document) {
            $this->redirect('/documents');
        }

        return $this->render('edit_document', ['document' => $document]);
    }

    private function handlePostRequest()
    {
        $uid = $_GET['uid'];

        $document = new Document($_POST['title'], $_POST['content'], Carbon::parse($_POST['createdAt']), null);

        $this->documentService->edit($uid, $document);

        $this->redirect("edit_document?uid={$uid}");
    }
}
