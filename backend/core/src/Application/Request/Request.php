<?php declare(strict_types=1);

namespace App\Application\Request;

use App\Application\Enum\RequestMethods;

class Request
{
    /**
     * @return string
     * @see RequestMethods
     */
    public function getMethod(): string
    {
        return (string) $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return (string) $_SERVER['REQUEST_URI'];
    }

    /**
     * @return array
     */
    public function getPostData(): array
    {
        $input = file_get_contents('php://input');

        return json_decode($input, true);
    }
}
