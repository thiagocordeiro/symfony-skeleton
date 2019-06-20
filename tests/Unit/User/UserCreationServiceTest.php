<?php declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidNameException;
use App\Domain\User\User;
use App\Domain\User\UserCreationService;
use App\Domain\User\Values\Email;
use App\Tests\Fixtures\Double\Infra\FakeUuidGenerator;
use App\Tests\Fixtures\Double\Infra\User\FakeUserRepository;
use PHPUnit\Framework\TestCase;

class UserCreationServiceTest extends TestCase
{
    private FakeUserRepository $repository;
    private UserCreationService $service;

    public function setUp(): void
    {
        $this->repository = new FakeUserRepository();
        $this->service = new UserCreationService($this->repository, new FakeUuidGenerator());
    }

    public function testWhenNameIsInvalidThenThrowNameError(): void
    {
        $name = '';

        $this->expectException(InvalidNameException::class);

        $this->service->create($name, 'local@local.com');
    }

    public function testWhenEmailIsInvalidThenThrowNameError(): void
    {
        $email = 'local@local';

        $this->expectException(InvalidEmailException::class);

        $this->service->create('Arthur Dent', $email);
    }

    public function testWhenProvidedCorrectDataThenSaveUser(): void
    {
        $name = 'Arthur Dent';
        $email = 'local@local.com';

        $uuid = $this->service->create($name, $email);

        $expected = new User($uuid, $name, new Email($email));
        $this->assertEquals($expected, $this->repository->getTestUser());
    }
}
