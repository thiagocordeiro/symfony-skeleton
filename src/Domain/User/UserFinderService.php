<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Exception\UserNotFoundException;

class UserFinderService
{
    private UserFinder $repository;

    public function __construct(UserFinder $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws UserNotFoundException
     */
    public function find(string $id): User
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
