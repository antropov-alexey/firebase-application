<?php declare(strict_types=1);

namespace App\Image;

use App\Application\Enum\DatabaseResources;
use App\Application\Repository\AbstractFirebaseRepository;

class ImageRepository extends AbstractFirebaseRepository
{
    /**
     * @return string
     * @see DatabaseResources
     */
    public function getResourceName(): string
    {
        return DatabaseResources::IMAGE;
    }
}
