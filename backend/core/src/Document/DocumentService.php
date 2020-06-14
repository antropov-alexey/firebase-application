<?php declare(strict_types=1);

namespace App\Document;

use App\Exception\FirebaseApiException;
use Carbon\Carbon;

class DocumentService
{
    private DocumentFirebaseRepository $documentFirebaseRepository;

    public function __construct(DocumentFirebaseRepository $documentFirebaseRepository)
    {
        $this->documentFirebaseRepository = $documentFirebaseRepository;
    }

    /**
     * @param string $title
     * @param string $content
     *
     * @throws FirebaseApiException
     */
    public function save(string $title, string $content): void
    {
        $document = new Document($title, $content, Carbon::now(), null);

        $response = $this->documentFirebaseRepository->save($document);

        $document->setUid($response->getRecordUid());
    }

    public function edit(string $uid, Document $document)
    {
        $this->documentFirebaseRepository->modify($uid, $document);
    }

    public function getAll()
    {
        $documents = [];

        $response = $this->documentFirebaseRepository->getByParams([]);

        if ($response->getResponse()) {
            foreach (get_object_vars($response->getResponse()) as $uid => $object) {
                $documents[] = new Document(
                    $object->title,
                    $object->content,
                    Carbon::parse($object->createdAt),
                    $uid
                );
            }
        }

        return $documents;
    }

    public function getById(string $uid)
    {
        $response = $this->documentFirebaseRepository->getById($uid);

        $document = null;

        $responseObject = $response->getResponse();
        if ($responseObject) {
            $document = new Document(
                $responseObject->title,
                $responseObject->content,
                Carbon::parse($responseObject->createdAt),
                $uid
            );
        }

        return $document;
    }
}
