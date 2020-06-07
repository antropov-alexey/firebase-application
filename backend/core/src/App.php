<?php declare(strict_types=1);

namespace App;

use App\Application\Application;
use App\Application\Cookie\CookieService;
use App\Application\Routing\RoutingFactory;
use App\Application\Session\SessionService;
use App\Auth\AuthService;
use App\Auth\Jwt\JwtWrapper;
use App\User\UserFirebaseRepository;
use App\User\UserService;

class App
{
    private static ?FirebaseConnector $firebaseConnector = null;

    public static function Application()
    {
        return new Application(new RoutingFactory());
    }

    /**
     * @return FirebaseConnector
     */
    public static function FirebaseConnector(): FirebaseConnector
    {
        if ( ! self::$firebaseConnector) {
            self::$firebaseConnector = FirebaseConnector::make(
                getenv('FIREBASE_AUTH_KEY'),
                getenv('FIREBASE_PROJECT_ID')
            );
        }

        return self::$firebaseConnector;
    }

    public static function AuthService()
    {
        return new AuthService(
            self::FirebaseConnector()->auth(),
            new JwtWrapper(
                base64_decode(getenv('JWT_PUBLIC_KEY_BASE64')),
                'RS256'
            ),
            new UserService(
                new UserFirebaseRepository(self::FirebaseConnector()->database())
            ),
            new CookieService(),
            new SessionService()
        );
    }
}
