<?php declare(strict_types=1);

namespace App\Framework\Controller;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\UserFinderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController
{
    private UserFinderService $service;

    public function __construct(UserFinderService $service)
    {
        $this->service = $service;
    }

    public function __invoke(string $email): JsonResponse
    {
        try {
            $user = $this->service->findByEmail($email);
        } catch (UserNotFoundException $e) {
            throw new HttpException(Response::HTTP_NOT_FOUND, $e->getMessage(), $e);
        }

        return new JsonResponse([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
        ]);
    }
}
