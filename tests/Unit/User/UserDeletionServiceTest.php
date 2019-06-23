<?php declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserDeleter;
use App\Domain\User\UserDeletionService;
use App\Domain\User\Values\Email;
use App\Tests\Fixtures\Double\Infra\User\FakeUserRepository;
use PHPUnit\Framework\TestCase;

class UserDeletionServiceTest extends TestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';

    private UserDeleter $deleter;
    private UserDeletionService $service;

    public function setUp(): void
    {
        $this->deleter = $this->createMock(UserDeleter::class);
        $this->service = new UserDeletionService(new FakeUserRepository(), $this->deleter);
    }

    public function testWhenUserIsNotFoundThenThrowError(): void
    {
        $id = 'abc-123';

        $this->expectException(UserNotFoundException::class);

        $this->service->delete($id);
    }

    public function testWhenUserIsFoundThenDelete(): void
    {
        $id = self::USER_ID;

        $user = new User($id, 'Local Tester', new Email('test@localhost.com'));
        $this->deleter->expects($this->once())->method('delete')->with($user);

        $this->service->delete($id);
    }
}
