<?php declare(strict_types=1);

namespace App\Document;

use App\Model\Database\DatabaseModelInterface;
use Carbon\Carbon;

class Document implements DatabaseModelInterface
{
    private string  $title;
    private string  $content;
    private Carbon  $createdAt;
    private ?string $uid = null;

    public function __construct(string $title, string $content, Carbon $createdAt, ?string $uid)
    {
        $this->title     = $title;
        $this->content   = $content;
        $this->createdAt = $createdAt;
        $this->uid       = $uid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * @param string|null $uid
     */
    public function setUid(?string $uid): void
    {
        $this->uid = $uid;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
