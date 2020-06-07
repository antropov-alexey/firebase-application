<?php declare(strict_types=1);

namespace App\Auth;

use App\Api\Auth;
use App\Application\Cookie\CookieKeys;
use App\Application\Cookie\CookieService;
use App\Application\Session\SessionKeys;
use App\Application\Session\SessionService;
use App\Auth\Jwt\JwtWrapper;
use App\Exception\ApiException;
use App\Exception\FirebaseApiException;
use App\User\User;
use App\User\UserService;

class AuthService
{
    private Auth           $auth;
    private JwtWrapper     $jwtWrapper;
    private UserService    $userService;
    private CookieService  $cookieService;
    private SessionService $sessionService;

    public function __construct(
        Auth $auth,
        JwtWrapper $jwtWrapper,
        UserService $userService,
        CookieService $cookieService,
        SessionService $sessionService
    )
    {
        $this->auth           = $auth;
        $this->jwtWrapper     = $jwtWrapper;
        $this->userService    = $userService;
        $this->cookieService  = $cookieService;
        $this->sessionService = $sessionService;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @throws ApiException
     * @throws FirebaseApiException
     */
    public function login(string $email, string $password)
    {
        try {
            $loginResponse = $this->auth->login($email, $password);
        }
        catch (FirebaseApiException $e) {
            throw new ApiException($e);
        }

        $this->verifyIdToken($loginResponse->getIdToken());

        $this->saveTokensInCookie(
            $loginResponse->getIdToken(),
            $loginResponse->getRefreshToken(),
            $loginResponse->getExpiresIn()
        );

        $user = $this->userService->getByEmail($email);

        $this->saveUserIdInSession($user->getUid());
    }

    private function verifyIdToken(string $idToken)
    {
        $this->jwtWrapper->verify($idToken);
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $name
     *
     * @throws ApiException
     * @throws FirebaseApiException
     */
    public function register(string $email, string $password, string $name)
    {
        try {
            $registerResponse = $this->auth->register($email, $password);
        }
        catch (FirebaseApiException $e) {
            throw new ApiException($e);
        }

        $this->verifyIdToken($registerResponse->getIdToken());

        $this->saveTokensInCookie(
            $registerResponse->getIdToken(),
            $registerResponse->getRefreshToken(),
            $registerResponse->getExpiresIn()
        );

        $user = new User($name, $email);

        $this->userService->save($user);

        $this->saveUserIdInSession($user->getUid());
    }

    /**
     * @param string $idToken
     * @param string $refreshToken
     * @param int    $expiresIn
     */
    private function saveTokensInCookie(
        string $idToken,
        string $refreshToken,
        int $expiresIn
    ): void
    {
        $this->cookieService->set(CookieKeys::ID_TOKEN, $idToken, $expiresIn);
        $this->cookieService->set(CookieKeys::REFRESH_TOKEN, $refreshToken, $expiresIn);
    }

    /**
     * @param string $userId
     */
    private function saveUserIdInSession(string $userId): void
    {
        $this->sessionService->set(SessionKeys::USER_ID, $userId);
    }

    public function logout(): void
    {
        $this->sessionService->clearSession();
        $this->cookieService->remove(CookieKeys::ID_TOKEN);
        $this->cookieService->remove(CookieKeys::REFRESH_TOKEN);
    }

    /**
     * @return User|null
     * @throws FirebaseApiException
     */
    public function getAuthorizedUser(): ?User
    {
        $userId = $this->sessionService->get(SessionKeys::USER_ID);

        return $userId ? $this->userService->getById($userId) : null;
    }
}
