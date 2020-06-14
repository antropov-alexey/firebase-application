<?php declare(strict_types=1);

namespace App\User;

use App\Model\Database\DatabaseModelInterface;

class User implements DatabaseModelInterface
{
    private ?string $uid;
    private string  $name;
    private string  $email;

    public function __construct(string $name, string $email, string $uid = null)
    {
        $this->name  = $name;
        $this->email = $email;
        $this->uid   = $uid;
    }

    /**
     * @return string|null
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     */
    public function setUid(string $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
