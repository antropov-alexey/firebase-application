<?php declare(strict_types=1);

namespace App\Document;

use App\Application\Enum\DatabaseResources;
use App\Application\Repository\AbstractFirebaseRepository;

class DocumentFirebaseRepository extends AbstractFirebaseRepository
{
    /**
     * @return string
     * @see DatabaseResources
     */
    public function getResourceName(): string
    {
        return DatabaseResources::DOCUMENT;
    }
}
