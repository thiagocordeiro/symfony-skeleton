<?php declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidNameException;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserUpdater;
use App\Domain\User\UserUpdateService;
use App\Domain\User\Values\Email;
use App\Tests\Fixtures\Double\Infra\User\FakeUserRepository;
use PHPUnit\Framework\TestCase;

class UserUpdateServiceTest extends TestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';

    private UserUpdater $updater;
    private UserUpdateService $service;

    public function setUp(): void
    {
        $this->updater = $this->createMock(UserUpdater::class);
        $this->service = new UserUpdateService(new FakeUserRepository(), $this->updater);
    }

    public function testWhenNameIsInvalidThenThrowNameError(): void
    {
        $name = '';

        $this->expectException(InvalidNameException::class);

        $this->service->update(self::USER_ID, $name, 'local@local.com');
    }

    public function testWhenEmailIsInvalidThenThrowNameError(): void
    {
        $email = 'local@local';

        $this->expectException(InvalidEmailException::class);

        $this->service->update(self::USER_ID, 'Arthur Dent', $email);
    }

    public function testWhenUserIsNotFoundThenThrowError(): void
    {
        $id = 'abc-123';

        $this->expectException(UserNotFoundException::class);

        $this->service->update($id, 'Arthur Dent', 'local@local.com');
    }

    public function testWhenProvidedCorrectDataThenUpdateUser(): void
    {
        $name = 'Arthur Dent';
        $email = 'arthur.dent@galaxy.net';
        $id = self::USER_ID;

        $user = new User($id, $name, new Email($email));
        $this->updater->expects($this->once())->method('update')->with($user);

        $this->service->update($id, $name, $email);
    }
}
