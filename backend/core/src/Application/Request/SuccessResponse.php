<?php declare(strict_types=1);

namespace App\Application\Request;

use JsonSerializable;

class SuccessResponse implements JsonSerializable
{
    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'state' => 'success',
        ];
    }
}
