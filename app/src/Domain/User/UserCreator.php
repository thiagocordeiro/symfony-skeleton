<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Exception\UnableToSaveUserException;

interface UserCreator
{
    /**
     * @throws UnableToSaveUserException
     */
    public function create(User $user): void;
}
