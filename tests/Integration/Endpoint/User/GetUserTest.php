<?php declare(strict_types=1);

namespace App\Tests\Integration\Endpoint\User;

use App\Tests\Integration\IntegrationTestCase;

class GetUserTest extends IntegrationTestCase
{
    private const USER_ID = '99f1a67d-4176-4f7d-96e4-d5897ac4a800';

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testWhenUserDoesNotExistThenThrowNotFoundError(): void
    {
        $response = $this->get(sprintf('/api/users/%s', 'aaa-bbb-ccc'));

        $content = (string) $response->getContent();

        $this->assertEquals('{"status":404,"message":"User Not Found"}', $content);
    }
}
