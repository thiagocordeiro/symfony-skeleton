<?php declare(strict_types=1);

namespace App\Framework\Controller\User;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidNameException;
use App\Domain\User\Exception\UnableToSaveUserException;
use App\Domain\User\UserCreationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterUserController
{
    private UserCreationService $service;

    public function __construct(UserCreationService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode((string) $request->getContent(), true);
        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';

        try {
            $uuid = $this->service->create($name, $email);
        } catch (InvalidEmailException | InvalidNameException $e) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, $e->getMessage(), $e);
        } catch (UnableToSaveUserException $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage(), $e);
        }

        return new JsonResponse(['id' => $uuid], Response::HTTP_CREATED);
    }
}
