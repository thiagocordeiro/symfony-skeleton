<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Exception\UnableToDeleteUserException;
use App\Domain\User\Exception\UserNotFoundException;

class UserDeletionService
{
    private UserFinder $finder;
    private UserDeleter $deleter;

    public function __construct(UserFinder $finder, UserDeleter $deleter)
    {
        $this->finder = $finder;
        $this->deleter = $deleter;
    }

    /**
     * @throws UnableToDeleteUserException
     * @throws UserNotFoundException
     */
    public function delete(string $id): void
    {
        $user = $this->finder->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $this->deleter->delete($user);
    }
}
