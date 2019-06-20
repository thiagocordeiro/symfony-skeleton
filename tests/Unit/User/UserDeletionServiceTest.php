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
        $id = 'abc-123';

        $this->expectException(UserNotFoundException::class);

        $this->service->delete($id);
    }

    public function testWhenUserIsFoundThenDelete(): void
    {
        $id = self::USER_ID;

        $this->service->delete($id);

        $this->assertNull($this->repository->getTestUser());
    }
}
