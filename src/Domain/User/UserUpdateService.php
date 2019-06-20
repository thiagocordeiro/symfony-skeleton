<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidNameException;
use App\Domain\User\Exception\UnableToSaveUserException;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Values\Email;

class UserUpdateService
{
    private UserFinder $finder;
    private UserUpdater $updater;

    public function __construct(UserFinder $finder, UserUpdater $updater)
    {
        $this->finder = $finder;
        $this->updater = $updater;
    }

    /**
     * @throws InvalidEmailException
     * @throws UnableToSaveUserException
     * @throws UserNotFoundException
     * @throws InvalidNameException
     */
    public function update(string $id, string $name, string $email): void
    {
        if (!$name) {
            throw new InvalidNameException();
        }

        $user = $this->finder->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $this->updater->update(new User($id, $name, new Email($email)));
    }
}
