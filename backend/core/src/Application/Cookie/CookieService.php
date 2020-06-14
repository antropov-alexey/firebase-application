<?php declare(strict_types=1);

namespace App\Application\Cookie;

class CookieService
{
    /**
     * @param string $name
     * @param string $value
     * @param int    $expiresInSeconds
     */
    public function set(string $name, string $value, int $expiresInSeconds)
    {
        $expires = time() + $expiresInSeconds;

        setcookie($name, $value, $expires);
    }

    /**
     * @param string $name
     */
    public function remove(string $name)
    {
        setcookie($name, '', -1);
    }

    /**
     * @param string $name
     *
     * @return string|null
     */
    public function get(string $name): ?string
    {
        return $_COOKIE[$name] ?? null;
    }
}
