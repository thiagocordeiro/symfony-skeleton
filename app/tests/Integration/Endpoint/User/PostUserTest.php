<?php declare(strict_types=1);

namespace App\Tests\Integration\Endpoint\User;

use App\Tests\Integration\IntegrationTestCase;

class PostUserTest extends IntegrationTestCase
{
    private const EMAIL = 'test@localhost.com';

    public function testWhenGivenEmptyNameThenReturnBadRequest(): void
    {
        $data = ['name' => '', 'email' => self::EMAIL];

        $response = $this->post('/api/users', $data);

        $this->assertEquals('{"status":400,"message":"Invalid Name"}', (string) $response->getContent());
    }

    public function testWhenGivenInvalidEmailThenReturnBadRequest(): void
    {
        $data = ['name' => 'Local Tester', 'email' => 'local@test'];

        $response = $this->post('/api/users', $data);

        $this->assertEquals('{"status":400,"message":"Invalid Email"}', (string) $response->getContent());
    }

    public function testWhenGivenCorrectDataThenCreateUserAndReturnItsId(): void
    {
        $data = ['name' => 'Local Tester', 'email' => self::EMAIL];

        $response = $this->post('/api/users', $data);

        $this->assertEquals('{"id":"c6a122d6-827c-428a-9dfd-048f39c6d7e6"}', (string) $response->getContent());
    }
}
