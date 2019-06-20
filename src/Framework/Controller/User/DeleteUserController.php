<?php declare(strict_types=1);

namespace App\Framework\Controller\User;

use App\Domain\User\Exception\UnableToDeleteUserException;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\UserDeletionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeleteUserController
{
    private UserDeletionService $service;

    public function __construct(UserDeletionService $service)
    {
        $this->service = $service;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            $this->service->delete($id);
        } catch (UserNotFoundException $e) {
            throw new HttpException(Response::HTTP_NOT_FOUND, $e->getMessage(), $e);
        } catch (UnableToDeleteUserException $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage(), $e);
        }

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
