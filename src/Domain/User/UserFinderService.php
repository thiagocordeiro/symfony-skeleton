<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Exception\UserNotFoundException;

class UserFinderService
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws UserNotFoundException
     */
    public function findByEmail(string $email): User
    {
        $user = $this->repository->findByEmail($email);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
