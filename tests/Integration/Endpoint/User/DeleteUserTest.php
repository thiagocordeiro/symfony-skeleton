<?php declare(strict_types=1);

namespace App\Tests\Integration\Endpoint\User;

use App\Tests\Integration\IntegrationTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserTest extends IntegrationTestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';

    public function testWhenUserDoesNotExistThenThrowNotFoundError(): void
    {
        $response = $this->delete(sprintf('/api/users/%s', 'aaa-bbb-ccc'));

        $this->assertEquals('{"status":404,"message":"User Not Found"}', (string) $response->getContent());
    }

    public function testWhenUserExistsThenDeleteAndReturnNoContent(): void
    {
        $response = $this->delete(sprintf('/api/users/%s', self::USER_ID));

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}
