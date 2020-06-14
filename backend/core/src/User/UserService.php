<?php declare(strict_types=1);

namespace App\User;

use App\Exception\FirebaseApiException;

class UserService
{
    private UserFirebaseRepository $userRepository;

    public function __construct(UserFirebaseRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     *
     * @throws FirebaseApiException
     */
    public function save(User $user)
    {
        $saveUserResponse = $this->userRepository->save($user);

        $user->setUid($saveUserResponse->getRecordUid());
    }

    /**
     * @param string $email
     *
     * @return User|null
     * @throws FirebaseApiException
     */
    public function getByEmail(string $email): ?User
    {
        return $this->userRepository->getByEmail($email);
    }

    /**
     * @param string $userId
     *
     * @return User
     * @throws FirebaseApiException
     */
    public function getById(string $userId): User
    {
        $response = $this->userRepository->getById($userId);

        return new User(
            $response->getResponse()->name,
            $response->getResponse()->email,
            $userId
        );
    }
}
