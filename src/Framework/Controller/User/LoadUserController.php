<?php declare(strict_types=1);

namespace App\Framework\Controller\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\UserFinderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoadUserController
{
    private UserFinderService $service;

    public function __construct(UserFinderService $service)
    {
        $this->service = $service;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            $user = $this->service->find($id);
        } catch (UserNotFoundException $e) {
            throw new HttpException(Response::HTTP_NOT_FOUND, $e->getMessage(), $e);
        }

        return new JsonResponse([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => (string) $user->getEmail(),
        ]);
    }
}
