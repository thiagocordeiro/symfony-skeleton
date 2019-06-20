<?php declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\UserDeletionService;
use App\Tests\Fixtures\Double\Infra\User\FakeUserRepository;
use PHPUnit\Framework\TestCase;

class UserDeletionServiceTest extends TestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';

    private FakeUserRepository $repository;
    private UserDeletionService $service;

    public function setUp(): void
    {
        $this->repository = new FakeUserRepository();
        $this->service = new UserDeletionService($this->repository, $this->repository);
    }

    public function testWhenUserIsNotFoundThenThrowError(): void
    {
        $this->expectException(UserNotFoundException::class);

        $this->service->delete('abc-123');
    }

    public function testWhenUserIsFoundThenDelete(): void
    {
        $this->service->delete(self::USER_ID);

        $this->assertNull($this->repository->getTestUser());
    }
}
