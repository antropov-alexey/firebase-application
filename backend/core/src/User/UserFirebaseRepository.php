<?php declare(strict_types=1);

namespace App\User;

use App\Application\Enum\DatabaseResources;
use App\Application\Repository\AbstractFirebaseRepository;
use App\Exception\FirebaseApiException;

class UserFirebaseRepository extends AbstractFirebaseRepository
{
    /**
     * @return string
     * @see DatabaseResources
     */
    public function getResourceName(): string
    {
        return DatabaseResources::USER;
    }

    /**
     * @param string $email
     *
     * @return User|null
     * @throws FirebaseApiException
     */
    public function getByEmail(string $email): ?User
    {
        $response = $this->getByParams(['email' => $email]);

        foreach (get_object_vars($response->getResponse()) as $uid => $object) {
            if ($object->email === $email) {
                return new User($object->name, $object->email, $uid);
            }
        }

        return null;
    }
}
