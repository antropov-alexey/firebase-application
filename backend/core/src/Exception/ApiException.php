<?php declare(strict_types=1);

namespace App\Exception;

use Exception;
use JsonSerializable;

class ApiException extends Exception implements JsonSerializable
{
    private FirebaseApiException $exception;

    public function __construct(FirebaseApiException $exception)
    {
        $this->exception = $exception;
        parent::__construct();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'errorCode' => $this->exception->getErrorCode(),
        ];
    }
}
