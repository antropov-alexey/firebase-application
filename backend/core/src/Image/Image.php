<?php declare(strict_types=1);

namespace App\Image;

use App\Model\Database\DatabaseModelInterface;

class Image implements DatabaseModelInterface
{
    private string  $type;
    private string  $authorId;
    private ?string $uid = null;

    public function __construct(string $type, string $authorId, ?string $uid)
    {
        $this->type     = $type;
        $this->authorId = $authorId;
        $this->uid      = $uid;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getAuthorId(): string
    {
        return $this->authorId;
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
