<?php declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidNameException;
use App\Domain\User\UserCreationService;
use App\Domain\User\UserCreator;
use App\Tests\Fixtures\Double\Infra\FakeUuidGenerator;
use PHPUnit\Framework\TestCase;

class UserCreationServiceTest extends TestCase
{
    private UserCreator $creator;
    private UserCreationService $service;

    public function setUp(): void
    {
        $this->creator = $this->createMock(UserCreator::class);
        $this->service = new UserCreationService($this->creator, new FakeUuidGenerator());
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

        $this->creator->expects($this->once())->method('create');

        $this->service->create($name, $email);
    }
}
