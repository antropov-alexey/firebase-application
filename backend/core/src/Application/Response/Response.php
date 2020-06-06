<?php declare(strict_types=1);

namespace App\Application\Response;

class Response
{
    private string $content;
    private int    $status;

    public function __construct(string $content, int $status)
    {
        $this->content = $content;
        $this->status  = $status;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
