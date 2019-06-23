<?php declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserFinder;
use App\Domain\User\UserFinderService;
use App\Domain\User\Values\Email;
use PHPUnit\Framework\TestCase;

class UserFinderServiceTest extends TestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';
    private const EMAIL = 'test@localhost.com';
    private const NAME = 'Local Tester';

    private UserFinder $finder;
    private UserFinderService $service;

    public function setUp(): void
    {
        $this->finder = $this->createMock(UserFinder::class);
        $this->service = new UserFinderService($this->finder);
    }

    public function testWhenUserIsNotFoundThenThrowError(): void
    {
        $id = 'abc-123';

        $this->expectException(UserNotFoundException::class);

        $this->service->find($id);
    }

    public function testWhenUserIsFoundThenReturnIt(): void
    {
        $id = self::USER_ID;

        $this->finder
            ->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn(new User(self::USER_ID, self::NAME, new Email(self::EMAIL)));

        $this->service->find($id);
    }
}
