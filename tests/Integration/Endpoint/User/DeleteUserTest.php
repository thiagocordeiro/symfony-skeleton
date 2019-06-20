<?php declare(strict_types=1);

namespace App\Tests\Integration\Endpoint\User;

use App\Tests\Integration\IntegrationTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserTest extends IntegrationTestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';

    public function testWhenUserDoesNotExistThenThrowNotFoundError(): void
    {
        $id = 'aaa-bbb-ccc';

        $response = $this->delete(sprintf('/api/users/%s', $id));

        $this->assertEquals('{"status":404,"message":"User Not Found"}', (string) $response->getContent());
    }

    public function testWhenUserExistsThenDeleteAndReturnNoContent(): void
    {
        $id = self::USER_ID;

        $response = $this->delete(sprintf('/api/users/%s', $id));

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}
