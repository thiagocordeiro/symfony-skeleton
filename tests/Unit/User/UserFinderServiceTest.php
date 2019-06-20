<?php declare(strict_types=1);

namespace App\Tests\Unit\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserFinderService;
use App\Domain\User\Values\Email;
use App\Tests\Fixtures\Double\Infra\User\FakeUserRepository;
use PHPUnit\Framework\TestCase;

class UserFinderServiceTest extends TestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';

    private FakeUserRepository $repository;
    private UserFinderService $service;

    public function setUp(): void
    {
        $this->repository = new FakeUserRepository();
        $this->service = new UserFinderService($this->repository);
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

        $user = $this->service->find($id);

        $expected = new User($id, 'Local Tester', new Email('test@localhost.com'));
        $this->assertEquals($expected, $user);
    }
}