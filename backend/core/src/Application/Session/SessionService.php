<?php declare(strict_types=1);

namespace App\Application\Session;

class SessionService
{
    /**
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function get(string $key): ?string
    {
        return $_SESSION[$key] ?? null;
    }

    public function clearSession()
    {
        session_unset();
    }
}
