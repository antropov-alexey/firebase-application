<?php declare(strict_types=1);

namespace App\Auth;

use App\Auth\Jwt\JwtWrapper;
use App\Exception\ApiException;
use App\Exception\FirebaseApiException;
use App\FirebaseConnector;

class AuthService
{
    private FirebaseConnector $firebaseConnector;
    private JwtWrapper        $jwtWrapper;

    public function __construct(FirebaseConnector $firebaseConnector, JwtWrapper $jwtWrapper)
    {
        $this->firebaseConnector = $firebaseConnector;
        $this->jwtWrapper        = $jwtWrapper;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @throws ApiException
     */
    public function login(string $email, string $password)
    {
        try {
            $loginResponse = $this->firebaseConnector->auth()->login($email, $password);
        }
        catch (FirebaseApiException $e) {
            throw new ApiException($e);
        }

        $this->verifyIdToken($loginResponse->getIdToken());
    }

    private function verifyIdToken(string $idToken)
    {
        $this->jwtWrapper->verify($idToken);
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @throws ApiException
     */
    public function register(string $email, string $password)
    {
        try {
            $registerResponse = $this->firebaseConnector->auth()->register($email, $password);
        }
        catch (FirebaseApiException $e) {
            throw new ApiException($e);
        }

        $this->verifyIdToken($registerResponse->getIdToken());
    }
}
