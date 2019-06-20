<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Exception\UnableToSaveUserException;

interface UserUpdater
{
    /**
     * @throws UnableToSaveUserException
     */
    public function update(User $user): void;
}
