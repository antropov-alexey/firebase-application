<?php declare(strict_types=1);

namespace App\Auth;

use App\Exception\ApiException;
use App\Exception\FirebaseApiException;
use App\FirebaseConnector;

class AuthService
{
    private FirebaseConnector $firebaseConnector;

    public function __construct(FirebaseConnector $firebaseConnector)
    {
        $this->firebaseConnector = $firebaseConnector;
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
            $this->firebaseConnector->auth()->login($email, $password);
        }
        catch (FirebaseApiException $e) {
            throw new ApiException($e);
        }
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
            $this->firebaseConnector->auth()->register($email, $password);
        }
        catch (FirebaseApiException $e) {
            throw new ApiException($e);
        }
    }
}
