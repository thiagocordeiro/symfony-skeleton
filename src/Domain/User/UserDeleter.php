<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Exception\UnableToDeleteUserException;

interface UserDeleter
{
    /**
     * @throws UnableToDeleteUserException
     */
    public function delete(User $user): void;
}
