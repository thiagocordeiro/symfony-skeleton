<?php declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidNameException;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserUpdateService;
use App\Domain\User\Values\Email;
use App\Tests\Fixtures\Double\Infra\User\FakeUserRepository;
use PHPUnit\Framework\TestCase;

class UserUpdateServiceTest extends TestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';

    private FakeUserRepository $repository;
    private UserUpdateService $service;

    public function setUp(): void
    {
        $this->repository = new FakeUserRepository();
        $this->service = new UserUpdateService($this->repository, $this->repository);
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

        $this->service->update(self::USER_ID, $name, $email);

        $expected = new User(self::USER_ID, $name, new Email($email));
        $this->assertEquals($expected, $this->repository->getTestUser());
    }
}
