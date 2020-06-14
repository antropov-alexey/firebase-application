<?php declare(strict_types=1);

namespace App\Auth\Jwt;

use Firebase\JWT\JWT;

class JwtWrapper
{
    private string $jwtKey;
    private string $algorithm;

    public function __construct(string $jwtKey, string $algorithm)
    {
        $this->jwtKey    = $jwtKey;
        $this->algorithm = $algorithm;
    }

    /**
     * @param string $idToken
     */
    public function verify(string $idToken)
    {
        JWT::decode($idToken, $this->jwtKey, [$this->algorithm]);
    }
}
