<?php declare(strict_types=1);

namespace App\Tests\Fixtures\Infra\User;

use App\Domain\User\User;
use App\Domain\User\UserRepository;

class FakeUserRepository implements UserRepository
{
    private const EMAIL = 'test@localhost';
    private const USERNAME = 'test.local';

    public function findByEmail(string $email): ?User
    {
        if ($email !== 'test@localhost') {
            return null;
        }

        return new User(self::EMAIL, self::USERNAME);
    }
}
