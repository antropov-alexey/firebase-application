<?php declare(strict_types=1);

namespace App\Application\Repository;

use App\Api\Database;
use App\Application\Enum\DatabaseResources;
use App\Exception\FirebaseApiException;
use App\Model\Database\DatabaseModelInterface;
use App\Model\Response\Database\DatabaseGetResponse;
use App\Model\Response\Database\DatabaseWriteResponse;

abstract class AbstractFirebaseRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return string
     * @see DatabaseResources
     */
    abstract public function getResourceName(): string;

    /**
     * @param DatabaseModelInterface $model
     *
     * @return DatabaseWriteResponse
     * @throws FirebaseApiException
     */
    public function save(DatabaseModelInterface $model): DatabaseWriteResponse
    {
        return $this->database->write($this->getResourceName(), $model);
    }

    /**
     * @param string $resourceId
     *
     * @return DatabaseGetResponse
     * @throws FirebaseApiException
     */
    public function getById(string $resourceId): DatabaseGetResponse
    {
        return $this->database->get($this->getResourceName(), $resourceId);
    }

    /**
     * @param string                 $resourceId
     * @param DatabaseModelInterface $model
     *
     * @throws FirebaseApiException
     */
    public function modify(string $resourceId, DatabaseModelInterface $model): void
    {
        $this->database->edit($this->getResourceName(), $resourceId, $model);
    }

    /**
     * @param array $params
     *
     * @return DatabaseGetResponse
     * @throws FirebaseApiException
     */
    public function getByParams(array $params): DatabaseGetResponse
    {
        return $this->database->getByParams($this->getResourceName(), $params);
    }
}
