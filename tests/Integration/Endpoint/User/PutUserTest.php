<?php declare(strict_types=1);

namespace App\Tests\Integration\Endpoint\User;

use App\Tests\Integration\IntegrationTestCase;
use Symfony\Component\HttpFoundation\Response;

class PutUserTest extends IntegrationTestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';
    private const EMAIL = 'test@localhost.com';

    public function testWhenGivenEmptyNameThenReturnBadRequest(): void
    {
        $data = ['name' => '', 'email' => self::EMAIL];

        $response = $this->put(sprintf('/api/users/%s', self::USER_ID), $data);

        $this->assertEquals('{"status":400,"message":"Invalid Name"}', (string) $response->getContent());
    }

    public function testWhenGivenInvalidEmailThenReturnBadRequest(): void
    {
        $data = ['name' => 'Local Tester', 'email' => 'local@test'];

        $response = $this->put(sprintf('/api/users/%s', self::USER_ID), $data);

        $this->assertEquals('{"status":400,"message":"Invalid Email"}', (string) $response->getContent());
    }

    public function testWhenUserDoesNotExistThenThrowNotFoundError(): void
    {
        $data = ['name' => 'Local Tester', 'email' => 'local@test'];

        $response = $this->put(sprintf('/api/users/%s', 'aaa-bbb-ccc'), $data);

        $this->assertEquals('{"status":404,"message":"User Not Found"}', (string) $response->getContent());
    }

    public function testWhenGivenCorrectDataThenUpdateUserAndReturnNoContent(): void
    {
        $data = ['name' => 'Local Tester', 'email' => 'local@test.com'];

        $response = $this->put(sprintf('/api/users/%s', self::USER_ID), $data);

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}
