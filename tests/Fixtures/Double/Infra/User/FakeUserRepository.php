<?php declare(strict_types=1);

namespace App\Tests\Fixtures\Double\Infra\User;

use App\Domain\User\User;
use App\Domain\User\UserCreator as Creator;
use App\Domain\User\UserDeleter as Delete;
use App\Domain\User\UserFinder as Finder;
use App\Domain\User\UserUpdater as Update;
use App\Domain\User\Values\Email;

class FakeUserRepository implements Finder, Creator, Update, Delete
{
    private const ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';
    private const EMAIL = 'test@localhost.com';
    private const NAME = 'Local Tester';

    /** @var User|null */
    private $testUser;

    public function findById(string $email): ?User
    {
        if ($email !== self::ID) {
            return null;
        }

        return new User(self::ID, self::NAME, new Email(self::EMAIL));
    }

    public function create(User $user): void
    {
        $this->testUser = $user;
    }

    public function update(User $user): void
    {
        $this->testUser = $user;
    }

    public function delete(User $user): void
    {
        $this->testUser = null;
    }

    public function getTestUser(): ?User
    {
        return $this->testUser;
    }
}
