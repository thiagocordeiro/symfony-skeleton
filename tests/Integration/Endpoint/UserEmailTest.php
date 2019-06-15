<?php declare(strict_types=1);

namespace App\Tests\Integration\Endpoint;

use App\Domain\User\UserRepository;
use App\Tests\Fixtures\Infra\User\FakeUserRepository;
use App\Tests\Integration\IntegrationTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserEmailTest extends IntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setService(UserRepository::class, new FakeUserRepository());
    }

    public function testWhenUserDoesNotExistThenThrowNotFoundError(): void
    {
        $response = $this->get('/users/user@localhost');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testWhenUserExistsThenReturnItsData(): void
    {
        $response = $this->get('/users/test@localhost');

        $content = (string) $response->getContent();

        $this->assertEquals('{"username":"test.local","email":"test@localhost"}', $content);
    }
}
