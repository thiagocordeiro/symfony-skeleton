<?php declare(strict_types=1);

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IntegrationTestCase extends WebTestCase
{
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    protected function setService(string $id, object $service): void
    {
        $this->client->getContainer()->set($id, $service);
    }

    protected function get(string $uri): Response
    {
        return $this->request(Request::METHOD_GET, $uri);
    }

    protected function post(string $uri, array $data): Response
    {
        return $this->request(Request::METHOD_POST, $uri, $data);
    }

    protected function put(string $uri, array $data): Response
    {
        return $this->request(Request::METHOD_PUT, $uri, $data);
    }

    protected function patch(string $uri, array $data): Response
    {
        return $this->request(Request::METHOD_PATCH, $uri, $data);
    }

    protected function delete(string $uri, array $data): Response
    {
        return $this->request(Request::METHOD_DELETE, $uri, $data);
    }

    private function request(string $method, string $uri, array $data = []): Response
    {
        $this->client->insulate();
        $this->client->request($method, $uri, [], [], [], json_encode($data));

        return $this->client->getResponse();
    }
}
