<?php declare(strict_types=1);

namespace App\Auth;

use App\Exception\FirebaseApiException;
use App\FirebaseConnector;

class AuthService
{
    private FirebaseConnector $firebaseConnector;

    public function __construct(FirebaseConnector $firebaseConnector)
    {
        $this->firebaseConnector = $firebaseConnector;
    }

    public function login(string $email, string $password)
    {
        try {
            $response = $this->firebaseConnector->auth()->login($email, $password);
        }
        catch (FirebaseApiException $e) {
        }
    }
}
